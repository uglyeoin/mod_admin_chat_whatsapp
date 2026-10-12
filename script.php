<?php

/**
 * @package     KindOfUseful.Module.AdminChatWhatsapp
 *
 * @copyright   (C) 2025-2026 Kind of Useful. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;

return new class () implements InstallerScriptInterface {
    private string $minimumPhp = '8.1.0';

    private string $minimumJoomla = '5.0.0';

    public function install(InstallerAdapter $adapter): bool
    {
        return true;
    }

    public function update(InstallerAdapter $adapter): bool
    {
        return true;
    }

    public function uninstall(InstallerAdapter $adapter): bool
    {
        return true;
    }

    public function preflight(string $type, InstallerAdapter $adapter): bool
    {
        if ($type === 'uninstall') {
            return true;
        }

        if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
            Factory::getApplication()->enqueueMessage(Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPhp), 'error');

            return false;
        }

        if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
            Factory::getApplication()->enqueueMessage(Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomla), 'error');

            return false;
        }

        return true;
    }

    public function postflight(string $type, InstallerAdapter $adapter): bool
    {
        if ($type !== 'update') {
            return true;
        }

        // 1.0.x saved the untranslated language key as the opening message. Clear it so
        // the translated default applies instead of "MOD_ADMIN_CHAT_..." being sent.
        $db    = Factory::getContainer()->get(\Joomla\Database\DatabaseInterface::class);
        $query = $db->getQuery(true)
            ->select([$db->quoteName('id'), $db->quoteName('params')])
            ->from($db->quoteName('#__modules'))
            ->where($db->quoteName('module') . ' = ' . $db->quote('mod_admin_chat_whatsapp'));

        foreach ($db->setQuery($query)->loadObjectList() as $row) {
            $params = json_decode((string) $row->params, true) ?: [];

            if (($params['prefilledtext'] ?? '') !== 'MOD_ADMIN_CHAT_WHATSAPP_PREFILLED_TEXT_DEFAULT') {
                continue;
            }

            $params['prefilledtext'] = '';

            $update = $db->getQuery(true)
                ->update($db->quoteName('#__modules'))
                ->set($db->quoteName('params') . ' = ' . $db->quote(json_encode($params)))
                ->where($db->quoteName('id') . ' = ' . (int) $row->id);

            $db->setQuery($update)->execute();
        }

        return true;
    }
};
