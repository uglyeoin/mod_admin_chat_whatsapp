<?php

/**
 * @package     KindOfUseful.Module.AdminChatWhatsapp
 *
 * @copyright   (C) 2025-2026 Kind of Useful. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace KindOfUseful\Module\AdminChatWhatsapp\Administrator\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Builds the wa.me link from the module settings.
 *
 * @since  1.0.0
 */
class Dispatcher extends AbstractModuleDispatcher
{
    protected function getLayoutData(): array
    {
        $data   = parent::getLayoutData();
        $params = $data['params'];

        $countryCode = preg_replace('/\D+/', '', (string) $params->get('countrycode', '')) ?? '';

        // Local format: drop spaces, "+", dashes and brackets, then the trunk zero.
        $number = ltrim(preg_replace('/\D+/', '', (string) $params->get('phonenumber', '')) ?? '', '0');

        // People often type the country code into the number too; don't send it twice.
        if ($countryCode !== '' && str_starts_with($number, $countryCode) && \strlen($number) > 10) {
            $number = substr($number, \strlen($countryCode));
        }

        $data['whatsappUrl'] = '';

        if ($countryCode !== '' && $number !== '') {
            $url = 'https://wa.me/' . $countryCode . $number;

            // WhatsApp only honours pre-filled text for business accounts.
            if ((string) $params->get('businessorpersonal', '0') === '0') {
                $message = trim((string) $params->get('prefilledtext', ''));

                if ($message === '') {
                    $message = Text::_('MOD_ADMIN_CHAT_WHATSAPP_PREFILLED_TEXT_DEFAULT');
                }

                $siteName = (string) Factory::getApplication()->get('sitename');
                $url     .= '?text=' . rawurlencode(Text::sprintf('MOD_ADMIN_CHAT_WHATSAPP_PREFILLED_TEXT', $message, $siteName));
            }

            $data['whatsappUrl'] = $url;
        }

        return $data;
    }
}
