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

        $phoneNumber = preg_replace("\+", "", $phoneNumber);
        $phoneNumber = preg_replace(" ", "", $phoneNumber);

        if ($phoneNumber) {
            $data['phonenumber'] = $phoneNumber;
        }

        return $data;
    }
}
