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
 * Generates the block contents : map and / or text
 */
function usersmap_generate_content($config) {
	global $DB;
	global $CFG;
	global $COURSE;
	global $PAGE;

	$PAGE->requires->css('/blocks/usersmap/css/leaflet.css');
	$PAGE->requires->css('/blocks/usersmap/css/MarkerCluster.css');
	$PAGE->requires->css('/blocks/usersmap/css/MarkerCluster.Default.css');
	$PAGE->requires->css('/blocks/usersmap/css/usersmap.css');

	$PAGE->requires->js('/blocks/usersmap/js/leaflet.js', true);
	$PAGE->requires->js('/blocks/usersmap/js/leaflet.markercluster.js', true);
	$PAGE->requires->js('/blocks/usersmap/js/usersmap.js', true);

	$content = '';

	// Leaflet Map.
	$content .= '<div id="usersmap-map" style="height: 180px;" class="">';
	$content .= '</div>';
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

	// Count all active users in Moodle.
    $displaynbmoodleusers = false;
    if (isset($config->displaynbmoodleusers)) {
        $displaynbmoodleusers = $config->displaynbmoodleusers;
    }
    if ($displaynbmoodleusers) {
		$r1 = "SELECT count(*) as nb FROM " . $CFG->prefix . "user WHERE confirmed = 1 AND deleted = 0 AND suspended = 0";
		$res = $DB->get_records_sql($r1, array());
		$singleresult = array_shift($res);
		$nbusers = $singleresult->nb;
		$content .= "<p>" . $nbusers . ' ' . get_string('nb_moodle_users', 'block_usersmap') . "</p>";
	}

	// Count all users enrolled in the current course.
    $displaynbenrolledusers = true;
    if (isset($config->displaynbenrolledusers)) {
        $displaynbenrolledusers = $config->displaynbenrolledusers;
    }
    if ($displaynbenrolledusers) {
		if ($COURSE->id != 1) { // Course n°1 is platform home.
			$r2 = "SELECT count(DISTINCT userid) as nb "
				. "FROM " . $CFG->prefix . "user_enrolments ue "
				. "LEFT JOIN " . $CFG->prefix . "enrol e ON e.id = ue.enrolid "
				. "WHERE e.courseid = " . $COURSE->id;
			$res = $DB->get_records_sql($r2, array());
			$singleresult = array_shift($res);
			$nbenrolledusers = $singleresult->nb;
			$content .= "<p>" . $nbenrolledusers . ' ' . get_string('nb_enrolled_users', 'block_usersmap') . "</p>";
		}
	}

	return $content;
}

/**
 * Called by the cron (scheduled task) to retrieve geolocation data based on
 * users cities
 */
function usersmap_update_geolocation($updateeveryone=false) {
	global $DB;
	global $CFG;

	$baseurl = get_config('usersmap', 'Geolocation_Url_Scheme');
	if (empty($baseurl)) {
		echo "ERROR Geolocation_Url_Scheme is not set";
		return false;
	}

	// Query all users having a city set in their profile
	$q = "SELECT id, city, country FROM " . $CFG->prefix . "user WHERE city != ''";
	if (! $updateeveryone) { // Only update users having no geolocation yet.
		$q .= "AND id NOT IN (SELECT userid FROM " . $CFG->prefix . "block_usersmap)";
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
			$lat = 'NULL';
			$lon = 'NULL';
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
		$qins = "INSERT INTO " . $CFG->prefix . "block_usersmap(userid, lat, lon) VALUES $valuesstring";
		//var_dump($qins);
		$DB->execute($qins);
	}
}