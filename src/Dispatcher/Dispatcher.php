<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  mod_admin_chat_whatsapp
 *
 * @copyright   (C) 2025 Eoin Oliver <https://www.squareballoon.co.uk>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\AdminChatWhatsapp\Administrator\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for mod_admin_chat_whatsapp
 *
 * @since  5.1.0
 */
class Dispatcher extends AbstractModuleDispatcher
{
    /**
     * Returns the layout data.
     *
     * @return  array
     *
     * @since   5.1.0
     */
    protected function getLayoutData()
    {
        $app = Factory::getApplication();
        $data = parent::getLayoutData();
        $phoneNumber = $data['params']->get('phonenumber');
        $sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
        $preFilledText = $data['params']->get('prefilledtext');
        $preFilledSiteName = Text::sprintf('MOD_ADMIN_CHAT_WHATSAPP_PREFILLED_TEXT', $preFilledText, $sitename);

        $phoneNumberNoSpacesAndPlusses = str_replace([" ", "+"], "", $phoneNumber);

        // Remove leading zero if present
        if (substr($phoneNumberNoSpacesAndPlusses, 0, 1) === '0') {
            $phoneNumberNoSpacesAndPlusses = ltrim($phoneNumberNoSpacesAndPlusses, '0');
        }


        $preFilledTextEncoded = urlencode($preFilledSiteName);


        $data['phonenumber'] = $phoneNumberNoSpacesAndPlusses;
        $data['countrycode'] = $data['params']->get('countrycode');
        $data['prefilledtext'] = $preFilledTextEncoded;

        return $data;
    }
}
