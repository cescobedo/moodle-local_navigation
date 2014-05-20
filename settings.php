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
 * Settings Custom Navigation local plugin.
 *
 * @package    local_navigation
 * @author     Carlos Escobedo <http://www.twitter.com/carlosagile>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_navigation', get_string('pluginname', 'local_navigation'));
    $settings->add(new admin_setting_configcheckbox('local_navigation/enabled', get_string('activate', 'local_navigation'),
        get_string('stractivate', 'local_navigation'), 0));
    $settings->add(new admin_setting_configtextarea('local_navigation/menuitems',
        get_string('items', 'local_navigation'), get_string('stritems', 'local_navigation'), '', PARAM_RAW));

     $ADMIN->add('appearance', $settings);
}