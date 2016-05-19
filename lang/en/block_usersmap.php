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
 * A Moodle block that shows a map of users
 *
 * English and french versions included / versions anglaise et française incluses.
 *
 * @package    block_usersmap
 * @category   blocks
 * @copyright  2016 Mathias Chouet, Tela Botanica
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['usersmap:addinstance'] = 'Add a Users map block';
$string['usersmap:myaddinstance'] = 'Add a Users map block to the My Moodle page';
$string['pluginname'] = 'Users map';
$string['block_usersmap_title'] = 'Users map';
$string['example_text'] = 'Howdy the great map :)';

$string['nb_moodle_users'] = 'users in Moodle';
$string['nb_enrolled_users'] = 'users in this course';

$string['error_tilserver_url_not_set'] = 'Tile server is set to "custom" but tile server URL is not set';

$string['config_display_nb_moodle_users'] = 'Display number of Moodle users below the map';
$string['config_display_nb_enrolled_users'] = 'Display number of users enrolled in the current course below the map';

$string['geolocation_url_scheme_text'] = 'Geolocation service URL scheme';
$string['geolocation_url_scheme_text_desc'] = 'Pseudo-field {city} will be replaced by user\'s city';
$string['tileserver_url_scheme_text'] = 'Tileserver URL scheme (base map layer)';
$string['tileserver_url_scheme_text_desc'] = 'Pseudo-fields {x}, {y} and {z} will be replaced by tiles indices and zoom level';
$string['tileserver_custom'] = 'Custom';
$string['tileserver_max_zoom_text'] = 'Max zoom';
$string['tileserver_max_zoom_text_desc'] = "Only concerns custom tile server";
$string['tileserver_attribution_text'] = 'Legal attribution to be displayed at the bottom of the map';
$string['tileserver_attribution_text_desc'] = "Only concerns custom tile server";

$string['scheduled_task_title'] = 'Update users geographical coordinates';
$string['scheduled_task_title_all'] = 'Update users geographical coordinates (ALL)';
$string['scheduled_task_start_message'] = 'Updating users geographical coordinates';
$string['scheduled_task_start_message_all'] = 'Updating users geographical coordinates (ALL)';
