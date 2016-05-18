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

/**
 * Generates a JS script to be appended after leaflet is loaded.
 */

global $CFG;
global $DB;

$content = '';

// Get all available users locations.
$r0 = "SELECT id, lat, lon FROM " . $CFG->prefix . "block_usersmap WHERE lat IS NOT NULL AND lon IS NOT NULL LIMIT 20";
$res = $DB->get_records_sql($r0, array());
if ($res) {
	// Generate JS code for markers.
	$jsmarkerscode = '<script type="text/javascript">' . PHP_EOL;
	foreach ($res as $r) {
		$jsmarkerscode .= 'var marker_' . $r->id . ' = L.marker([' . $r->lat . ', ' . $r->lon . ']);' . PHP_EOL;
		$jsmarkerscode .= 'usersLayer.addLayer(marker_' . $r->id . ');' . PHP_EOL;
	}
	$jsmarkerscode .= 'usersmap.fitBounds(usersLayer.getBounds());' . PHP_EOL;
	$jsmarkerscode .= '</script>' . PHP_EOL;
	$content .= $jsmarkerscode;
}

echo $content; // Output JS.