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
 * @copyright  2017 Carlos Escobedo <http://www.twitter.com/carlosagile>)
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Extend Navigation block and add options
 *
 * @param global_navigation $navigation {@link global_navigation}
 * @return void
 */
function local_navigation_extend_navigation(global_navigation $navigation) {
    $settings = get_config('local_navigation');
    if (!empty($settings->menuitems) && $settings->enabled) {
        $menu = new custom_menu($settings->menuitems, current_language());
        if ($menu->has_children()) {
            foreach ($menu->get_children() as $item) {
                navigation_custom_menu_item($item, 0, null, $settings->flatenabled);
            }
        }
    }
}

/**
 * ADD custom menu in navigation recursive childs node
 * Is like render custom menu items
 *
 * @param custom_menu_item $menunode {@link custom_menu_item}
 * @param int $parent is have a parent and it's parent itself
 * @param object $pmasternode parent node
 * @param int $flatenabled show master node in boost navigation
 * @return void
 */
function navigation_custom_menu_item(custom_menu_item $menunode, $parent, $pmasternode, $flatenabled) {
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
            $masternode = $pmasternode->add(local_navigation_get_string($menunode->get_text()),
                                            $url, navigation_node::TYPE_CONTAINER);
            $masternode->title($menunode->get_title());
        } else {
            $masternode = $PAGE->navigation->add(local_navigation_get_string($menunode->get_text()),
                                            $url, navigation_node::TYPE_CONTAINER);
            $masternode->title($menunode->get_title());
            if ($flatenabled) {
                $masternode->isexpandable = true;
                $masternode->showinflatnavigation = true;
            }
        }
        foreach ($menunode->get_children() as $menunode) {
            navigation_custom_menu_item($menunode, $submenucount, $masternode, $flatenabled);
        }
    } else {
        $url = $CFG->wwwroot;
        if ($menunode->get_url() !== null) {
            $url = new moodle_url($menunode->get_url());
        } else {
            $url = null;
        }
        if ($parent) {
            $childnode = $pmasternode->add(local_navigation_get_string($menunode->get_text()),
                                        $url, navigation_node::TYPE_CUSTOM);
            $childnode->title($menunode->get_title());
        } else {
            $masternode = $PAGE->navigation->add(local_navigation_get_string($menunode->get_text()),
                                        $url, navigation_node::TYPE_CONTAINER);
            $masternode->title($menunode->get_title());
            if ($flatenabled) {
                $masternode->isexpandable = true;
                $masternode->showinflatnavigation = true;
            }
        }
    }

    return true;
}

/**
 * Translate Custom Navigation Nodes
 *
 * This function is based in a short peace of Moodle code
 * in  Name processing on user_convert_text_to_menu_items.
 *
 * @param string $string text to translate.
 * @return string
 */
function local_navigation_get_string($string) {
    $title = $string;
    $text = explode(',', $string, 2);
    if (count($text) == 2) {
        // Check the validity of the identifier part of the string.
        if (clean_param($text[0], PARAM_STRINGID) !== '') {
            // Treat this as atext language string.
            $title = get_string($text[0], $text[1]);
        }
    }
    return $title;
}
