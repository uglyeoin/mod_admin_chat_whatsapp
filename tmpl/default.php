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

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die();

if(!empty($phonenumber)) {
?>
    <a href="https://wa.me/<?php echo $phoneNumber; ?>"><?php echo "<span class='me-1 fa-brands fa-whatsapp'></span>" . Text::_('MOD_ADMIN_CHAT_WHATSAPP_LINK_TEXT'); ?></a>
<?php
}
