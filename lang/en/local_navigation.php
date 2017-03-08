<?php
// This file is part of Open Drako - http://opendrako.org/
//
// Open Drako is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Open Drako is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Open Drako.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Navigation lang file.
 *
 * @package    local_navigation
 * @author     Carlos Escobedo <http://www.twitter.com/carlosagile>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Plugin Name.
$string['pluginname'] = 'Custom Navigation';
$string['activate'] = 'Enabled Custom Menu Navigation';
$string['stractivate'] = 'Enables add new items in Navigation Menu at the end.';
$string['items'] = 'Custom Navigation items: ';
$string['stritems'] = 'You can add custom items to the Navigation Menu using the following syntax.
Identical to that used in the custom menu at theme settings.
<br>
Now you can add in the line a tooltip title (optional) and a language code or comma-separated list of codes (optional, for displaying the line to users of the specified language only), separated by pipe characters. 
<br>
So you can use Moodle translate in the first argument on the line using
this way,   "langstringname, componentname".
<br>
For example:
<br>
Example:
<br>
Moodle community
<br>
-Moodle free support|http://moodle.org/support
<br>
-Moodle development|http://moodle.org/development
<br>
--Moodle Tracker|http://tracker.moodle.org|Bugs & features|en
<br>
--Moodle Docs|http://docs.moodle.org
<br>
---grade,grades|https://docs.moodle.org/31/en/Grades|Docs about grades|en,es
<br>
-Moodle News|http://moodle.org/news
<br>
Moodle company
<br>
-Moodle commercial hosting|http://moodle.com/hosting
<br>
-Moodle commercial support|http://moodle.com/support';
$string['flatenabled'] = 'Enabled Master nodes in Boost Navigation';
$string['strflatenabled'] = 'Enables add new mater items in Boost Navigation Menu at the end.';
