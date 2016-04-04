<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Extend navigation to add new options.
 *
 * @package    local_navigation
 * @author     Carlos Escobedo <http://www.twitter.com/carlosagile>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Extend Navigation block and add options
 *
 * @param object $navigation global_navigation
 * @return void
 */
function local_navigation_extend_navigation(global_navigation $navigation) {
    $settings = get_config('local_navigation');
    if (!empty($settings->menuitems) && $settings->enabled) {
        $menu = new custom_menu($settings->menuitems, current_language());
        if ($menu->has_children()) {
            foreach ($menu->get_children() as $item) {
                navigation_custom_menu_item($item, 0, null);
            }
        }
    }
}

/**
 * ADD custom menu in navigation recursive childs node
 * Is like render custom menu items
 *
 * @param object $navigation global_navigation
 * @param int $parent is have a parent and it's parent itself
 * @param object $pmasternode parent node
 * @return void
 */
function navigation_custom_menu_item(custom_menu_item $menunode, $parent, $pmasternode) {
    global $PAGE, $CFG;

    static $submenucount = 0;

    if ($menunode->has_children()) {
        $submenucount++;
        $url = $CFG->wwwroot;
        if ($menunode->get_url() !== null) {
            $url = new moodle_url($menunode->get_url());
        } else {
            $url = null;
        }
        if ($parent > 0) {
            $masternode = $pmasternode->add($menunode->get_text(), $url, navigation_node::TYPE_CONTAINER);
        } else {
            $masternode = $PAGE->navigation->add($menunode->get_text(), $url, navigation_node::TYPE_CONTAINER);
        }
        foreach ($menunode->get_children() as $menunode) {
            navigation_custom_menu_item($menunode, $submenucount, $masternode);
        }
    } else {
        $url = $CFG->wwwroot;
        if ($menunode->get_url() !== null) {
            $url = new moodle_url($menunode->get_url());
        } else {
            $url = null;
        }
        if ($parent) {
            $childnode = $pmasternode->add($menunode->get_text(), $url);
        } else {
            $masternode = $PAGE->navigation->add($menunode->get_text(), $url, navigation_node::TYPE_CONTAINER);
        }
    }

    return true;
}
