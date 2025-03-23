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
        $data = parent::getLayoutData();
        $phoneNumber = $data['params']->get('phonenumber');
        $preFilledText = $data['params']->get('prefilledtext');

        $phoneNumberNoSpacesAndPlusses = str_replace([" ", "+"], "", $phoneNumber);

        // Remove leading zero if present
        if (substr($phoneNumberNoSpacesAndPlusses, 0, 1) === '0') {
            $phoneNumberNoSpacesAndPlusses = ltrim($phoneNumberNoSpacesAndPlusses, '0');
        }

        $preFilledText = base64_encode($preFilledText);

        $data['phonenumber'] = $phoneNumberNoSpacesAndPlusses;
        $data['countrycode'] = $data['params']->get('countrycode');
        $data['prefilledtext'] = $preFilledText;

        return $data;
    }
}
