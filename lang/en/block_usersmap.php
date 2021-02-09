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

$string['error_tilserver_url_not_set'] = 'Tile server is set to "custom" but tile server URL is not set';

$string['config_display_nb_moodle_users'] = 'Display number of Moodle users below the map';
$string['config_display_nb_enrolled_users'] = 'Display number of users enrolled in the current course below the map';
$string['config_display_nb_moodle_users_format'] = "Display format for the number of Moodle users ({nb} will be replaced by the number)";
$string['config_display_nb_moodle_users_format_default'] = '{nb} users in Moodle';
$string['config_display_nb_moodle_users_format_countriemissing'] = '{nb} Registered on the platform that indicated their country';
$string['config_display_nb_enrolled_users_format'] = "Display format for the number of users enrolled in the current course ({nb} will be replaced by the number)";
$string['config_display_nb_enrolled_users_format_default'] = '{nb} users in this course';
$string['config_what_to_display'] = 'Whiwh utilisateurs should the map show ?';
$string['config_what_to_display_amu'] = 'All Moodle users';
$string['config_what_to_display_omu'] = 'All Moodle users who are online at the moment';
$string['config_what_to_display_aeu'] = 'All the users enrolled in the course';
$string['config_what_to_display_oeu'] = 'All the users enrolled in the course who are online at the moment';

$string['tileserver_url_scheme_text'] = 'Tile server URL scheme (base map layer)';
$string['tileserver_url_scheme_text_desc'] = 'Only concerns custom tile server. Pseudo-fields {x}, {y} and {z} will be replaced by tiles indices and zoom level';
$string['tileserver_custom'] = 'Custom';
$string['tileserver_select'] = 'Tile server';
$string['tileserver_select_desc'] = "Defines which base layer will be displayed on the map";
$string['tileserver_max_zoom_text'] = 'Max zoom';
$string['tileserver_max_zoom_text_desc'] = "Only concerns custom tile server";
$string['tileserver_attribution_text'] = 'Legal attribution to be displayed at the bottom of the map';
$string['tileserver_attribution_text_desc'] = "Only concerns custom tile server";
$string['geolocation_server_select'] = 'Geolocation service';
$string['geolocation_server_select_desc'] = "Defines which geolocation service will be used";
$string['geolocation_url_scheme_text'] = 'Geolocation service URL scheme';
$string['geolocation_url_scheme_text_desc'] = 'Only concerns custom geolocation service. Pseudo-fields {city} and {country} will be replaced by user\'s city and country. This service must return data in JSON format';
$string['geonames_username_text'] = "GeoNames username (required)";
$string['geonames_username_text_desc'] = "Only concerns GeoNames geolocation service. Go to http://www.geonames.org to create an account";
$string['geolocation_lat_field_text'] = "Field to retrieve latitude from";
$string['geolocation_lat_field_text_desc'] = "Only concerns custom geolocation service. The field will be extracted from JSON data returned by the service";
$string['geolocation_lon_field_text'] = "Field to retrieve longitude from";
$string['geolocation_lon_field_text_desc'] = "Only concerns custom geolocation service. The field will be extracted from JSON data returned by the service";

$string['scheduled_task_title'] = 'Update users geographical coordinates';
$string['scheduled_task_title_all'] = 'Update users geographical coordinates (ALL)';
$string['scheduled_task_start_message'] = 'Updating users geographical coordinates';
$string['scheduled_task_start_message_all'] = 'Updating users geographical coordinates (ALL)';

$string['countriesmissing_text'] = 'Allow countries missing';
$string['countriesmissing_text_desc'] = 'If this option is checked, the plugin will also process data that does not have a country defined';