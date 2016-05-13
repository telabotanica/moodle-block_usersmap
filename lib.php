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

function usersmap_generate_content() {
	return get_string('example_text', 'block_usersmap');
}

function usersmap_update_geolocation($updateeveryone=false) {
	global $DB;

	$baseurl = get_config('usersmap', 'Geolocation_Url_Scheme');
	if (empty($baseurl)) {
		echo "ERROR Geolocation_Url_Scheme is not set";
		return false;
	}

	// Query all users having a city set in their profile
	$q = "SELECT id, city, country FROM user WHERE city != ''";
	if (! $updateeveryone) { // Only update users having no geolocation yet.
		$q .= "AND id NOT IN (SELECT userid FROM block_usersmap)";
	}
	$q .= " ORDER BY RAND()"; // For debug purposes.
	$q .= " LIMIT 10";

	$res = $DB->get_records_sql($q, array());

	$values = array();
	if ($res) {
		foreach ($res as $r) {
			//var_dump($r);
			$url = str_replace('{{city}}', $r->city, $baseurl);
			//var_dump($url);
			$info = file_get_contents($url);
			$lat = null;
			$lon = null;
			if ($info) {
				$info = json_decode($info);
				//var_dump($info);
				$lat = $info->centre_lat;
				$lon = $info->centre_lng;
			}
			$values[] = "(" . $r->id . ", $lat, $lon)";
		}
		$valuesstring = implode(',', $values);
		// @TODO if update all, truncate table first or something
		$qins = "INSERT INTO block_usersmap(userid, lat, lon) VALUES $valuesstring";
		//var_dump($qins);
		$DB->execute($qins);
	}

	// 
	// foreach() {
	//		geoloc
	//		add to values
	// }
	// INSERT
}