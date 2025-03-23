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
use Joomla\Component\Menus\Administrator\Helper\MenusHelper;
use Joomla\Module\Menu\Administrator\Menu\CssMenu;

defined('_JEXEC') or die();

if (in_array($module->position, ['icon', 'cpanel'])) {
    $buttons = [
        [
            'image' => 'yo-quicklink-cpanel',
            'text' => 'YOOtheme',
            'link' => "index.php?option=com_ajax&templateStyle={$templ->id}&p=customizer&format=html",
            'group' => Text::_('MOD_YOOTHEME_LINK_TEMPLATES'),
            'access' => ['core.edit', 'com_templates'],
        ],
    ];

    require ModuleHelper::getLayoutPath('mod_quickicon');
}

if ($module->position === 'menu') {
    MenusHelper::addPreset('yootheme', 'YOOtheme', __DIR__ . '/../presets/yootheme.xml');

    $enabled = !$app->getInput()->getBool('hidemainmenu');

    $menu = new CssMenu($app);
    (fn() => ($this->enabled = $enabled))->bindTo($menu, $menu)();

    $root = MenusHelper::loadPreset('yootheme');
    $root->level = 0;

    // Render the module layout
    include ModuleHelper::getLayoutPath('mod_menu');
}

