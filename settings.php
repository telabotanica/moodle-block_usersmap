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

defined('MOODLE_INTERNAL') || die;

// Secttings header title according to language file.
$settings->add(new admin_setting_heading(
    'configheader',
    get_string('blocksettings', 'block'),
    ''
));

// Url scheme of geolocation webservice.
$settings->add(new admin_setting_configtext(
    'usersmap/Geolocation_Url_Scheme',
    get_string('geolocation_url_scheme_text', 'block_usersmap'),
    get_string('geolocation_url_scheme_text_desc', 'block_usersmap'),
    ''
));

// @TODO parameterize geolocation type / fields mapping (where to find "lat"
// and "lon" in service results)

// Tile server (predefined choices).
$settings->add(new admin_setting_configselect(
    'usersmap/Tileserver',
    get_string('tileserver_select', 'block_usersmap'),
    get_string('tileserver_select_desc', 'block_usersmap'),
    'osm',
	array(
		'osm' => 'OpenStreetMap',
		'gstreets' => 'Google Streets',
		'gsatellite' => 'Google Satellite',
		'custom' => get_string('tileserver_custom', 'block_usersmap')
	)
));

// Url scheme of tile server, for Custom mode.
$settings->add(new admin_setting_configtext(
    'usersmap/Tileserver_Url_Scheme',
    get_string('tileserver_url_scheme_text', 'block_usersmap'),
    get_string('tileserver_url_scheme_text_desc', 'block_usersmap'),
    ''
));

// Max zoom of tile server, for Custom mode.
$settings->add(new admin_setting_configtext(
    'usersmap/Tileserver_Max_Zoom',
    get_string('tileserver_max_zoom_text', 'block_usersmap'),
    get_string('tileserver_max_zoom_text_desc', 'block_usersmap'),
    ''
));

// Attribution mention on base layer, for Custom mode.
$settings->add(new admin_setting_configtext(
    'usersmap/Tileserver_Attribution',
    get_string('tileserver_attribution_text', 'block_usersmap'),
    get_string('tileserver_attribution_text_desc', 'block_usersmap'),
    ''
));