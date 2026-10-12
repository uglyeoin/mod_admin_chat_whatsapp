<?php

/**
 * @package     KindOfUseful.Module.AdminChatWhatsapp
 *
 * @copyright   (C) 2025-2026 Kind of Useful. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/** @var \stdClass $module */
/** @var string    $whatsappUrl */

$inMenu = $module->position === 'menu';

if ($inMenu) : ?>
<nav class="main-nav-container" aria-label="<?php echo Text::_('MOD_ADMIN_CHAT_WHATSAPP'); ?>">
	<ul id="whatsapp-click-to-chat" class="nav flex-column main-nav metismenu">
		<li class="item item-level-1">
<?php endif; ?>

<?php if ($whatsappUrl !== '') : ?>
			<a href="<?php echo htmlspecialchars($whatsappUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="nodropdown">
				<span class="me-1 fa-brands fa-whatsapp icon-whatsapp icon-fw" aria-hidden="true"></span>
				<?php echo Text::_('MOD_ADMIN_CHAT_WHATSAPP_LINK_TEXT'); ?>
			</a>
<?php else : ?>
			<span class="p-2 d-block"><?php echo Text::_('MOD_ADMIN_CHAT_WHATSAPP_NO_PHONE_NUMBER_NOT_SET'); ?></span>
<?php endif; ?>

<?php if ($inMenu) : ?>
		</li>
	</ul>
</nav>
<?php endif;
