<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  mod_admin_chat_whatsapp
 *
 * @copyright   (C) 2025 Eoin Oliver <https://www.squareballoon.co.uk>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if(!empty($phonenumber) || !empty($countrycode)) {
    if($businessorpersonal == "0") { // Business Account ?>
        <a href="https://wa.me/<?php echo $countrycode . $phonenumber . "?text=" . $prefilledtext; ?>"
            target="_blank"><?php echo "<span class='me-1 fa-brands fa-whatsapp'></span>" . Text::_('MOD_ADMIN_CHAT_WHATSAPP_LINK_TEXT'); ?></a>
    <?php
    }
    else { // Personal Account
    ?>
        <a href="https://wa.me/<?php echo $countrycode . $phonenumber; ?>" target="_blank"><?php echo '<span class="me-1 fa-brands fa-whatsapp"></span>' . Text::_('MOD_ADMIN_CHAT_WHATSAPP_LINK_TEXT'); ?></a>
    <?php
    }
}
else {
    echo Text::_('MOD_ADMIN_CHAT_WHATSAPP_NO_PHONE_NUMBER_NOT_SET');
}
