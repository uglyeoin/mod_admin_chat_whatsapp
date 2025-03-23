<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  mod_admin_chat_whatsapp
 *
 * @copyright   (C) 2025 Eoin Oliver <https://www.squareballoon.co.uk>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die();

if ($module->position === 'menu') {
    echo '<a href="https://wa.me/' . $data['phonenumber'] . '">' . Text::_('MOD_ADMIN_CHAT_WHATSAPP_LINK_TEXT') . '</a>';
}

// To do.  Remove + from entry sanitise.