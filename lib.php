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
	$PAGE->requires->css('/blocks/usersmap/css/Control.FullScreen.css');
	$PAGE->requires->css('/blocks/usersmap/css/usersmap.css');

	$PAGE->requires->js('/blocks/usersmap/js/leaflet.js', true);
	$PAGE->requires->js('/blocks/usersmap/js/leaflet.markercluster.js', true);
	$PAGE->requires->js('/blocks/usersmap/js/Control.FullScreen.js', true);

	$content = '';

	// Leaflet Map.
	$content .= '<div id="usersmap-map" class="">';
	$content .= '</div>';

	// Inline Javascript code because declaration order is important.
	$jsinitmapcode = '';
	$jsinitmapcode .= '<script type="text/javascript">' . PHP_EOL;

	// Build base layer based on settings.
	$tileservermode = get_config('usersmap', 'Tileserver');
	switch ($tileservermode) {
		case 'osm':
			$jsinitmapcode .= "baseLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',"
				. "{maxZoom: 20, attribution: 'Map data © <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors'});";
			break;
		case 'gstreets':
			$jsinitmapcode .= "baseLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',"
				. "{maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3']});";
			break;
		case 'gsatellite':
			$jsinitmapcode .= "baseLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',"
				. "{maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3']});";
			break;
		case 'custom':
		default:
			$layerurl = get_config('usersmap', 'Tileserver_Url_Scheme');
			if (empty($layerurl)) {
				throw new Exception(get_string('error_tilserver_url_not_set', 'block_usersmap'));
			}
			$layermaxzoom = get_config('usersmap', 'Tileserver_Max_Zoom');
			if (empty($layermaxzoom)) {
				$layermaxzoom = 20;
			}
			$layerattribution = get_config('usersmap', 'Tileserver_Attribution');
			$jsinitmapcode .= "baseLayer = L.tileLayer('$layerurl',"
				. "{maxZoom: $layermaxzoom, attribution: '$layerattribution'});";
			break;
	}

	$jsinitmapcode .= "var usersmap = L.map('usersmap-map', {fullscreenControl: true, fullscreenControlOptions: {position: 'topleft'}});" . PHP_EOL;
	$jsinitmapcode .= "baseLayer.addTo(usersmap);" . PHP_EOL;
	// Clustering layer.
	$jsinitmapcode .= "usersLayer = new L.MarkerClusterGroup({disableClusteringAtZoom : 10});";
	$jsinitmapcode .= "usersLayer.addTo(usersmap);" . PHP_EOL;
	// Change default icon because generated path is not understood by Moodle.
	$markerurl = new moodle_url('/blocks/usersmap/js/images/marker-icon.png');
	$jsinitmapcode .= "var newDefaultMarkerIcon = L.icon({iconUrl: '$markerurl', iconSize: [24,36], iconAnchor: [12,36]});";
	$jsinitmapcode .= "L.Marker.mergeOptions({icon: newDefaultMarkerIcon});";
	$jsinitmapcode .= '</script>' . PHP_EOL;

	// Append inline JS to content (this is a useless comment).
	$content .= $jsinitmapcode;

	// Get all available users locations.
	// @TODO Load GeoJSON directly from the database ? Which performance ?

	// Select users according to the instance config.
    $whattodisplay = 'aeu';
    if (isset($config->whattodisplay)) {
        $whattodisplay = $config->whattodisplay;
    }
	$onlineusersonly = in_array($whattodisplay, array('omu', 'oeu'));
	$enrolledusersonly = in_array($whattodisplay, array('aeu', 'oeu'));

	$r0 = "SELECT bu.id as id, bu.lat as lat, bu.lon as lon, bu.city as city, count(*) as nb "
		. "FROM " . $CFG->prefix . "block_usersmap bu ";
	$join = '';
	$where = array("lat IS NOT NULL", "lon IS NOT NULL");
	if ($onlineusersonly) {
		$join .= " LEFT JOIN user u ON u.id = bu.userid";
		$where[] = "UNIX_TIMESTAMP() - u.lastaccess < 900"; // 15 mn.
	}
	if ($enrolledusersonly && ($COURSE->id > 1)) { // Course n°1 is platform home.
		$join .= " LEFT JOIN user_enrolments ue ON ue.id = bu.userid LEFT JOIN enrol e ON e.id = ue.enrolid";
		$where[] = "e.courseid = " . $COURSE->id;
	}
	$r0 .= $join
		. " WHERE " . implode(' AND ', $where)
		. " GROUP BY lat, lon"; // City should always be the same for a given lat,lon pair.

	$res = $DB->get_records_sql($r0, array());

	$jsmarkerscode = '<script type="text/javascript">' . PHP_EOL;
	if ($res) {
		// Generate JS code for markers.
		$markerid = 1;
		foreach ($res as $r) {
			// Add multiple instance of the marker so that the clustering
			// plugin shows the right number of users in its icons.
			$realnbusers = $r->nb;
			for ($i = 0; $i < $realnbusers; $i++) {
				$jsmarkerscode .= 'var marker_' . $markerid . ' = L.marker([' . $r->lat . ', ' . $r->lon . ']);' . PHP_EOL;
				$jsmarkerscode .= 'usersLayer.addLayer(marker_' . $markerid . ');' . PHP_EOL;
				$jsmarkerscode .= 'marker_' . $markerid . '.bindPopup("' . $r->city . ' : ' . $r->nb . '").openPopup();';
				$markerid++;
			}
		}
		$jsmarkerscode .= 'usersmap.fitBounds(usersLayer.getBounds());' . PHP_EOL;
		$jsmarkerscode .= 'usersmap.setZoom(1);' . PHP_EOL;
	} else {
		$jsmarkerscode .= "usersmap.setView({lat:43.614203, lng:3.860752}, 1);" . PHP_EOL; // Center on Montpellier, best city in the world.
	}
	$jsmarkerscode .= '</script>' . PHP_EOL;
	$content .= $jsmarkerscode;

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
		$stringformat = get_string('config_display_nb_moodle_users_format_default', 'block_usersmap');
		if (isset($config->displaynbmoodleusers_format)) {
			$stringformat = $config->displaynbmoodleusers_format;
		}
		$message = str_replace('{nb}', $nbusers, $stringformat);
		$content .= "<p>$message</p>";
	}

	// Count all users enrolled in the current course.
    $displaynbenrolledusers = false;
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
			$stringformat = get_string('config_display_nb_enrolled_users_format_default', 'block_usersmap');
			if (isset($config->displaynbenrolledusers_format)) {
				$stringformat = $config->displaynbenrolledusers_format;
			}
			$message = str_replace('{nb}', $nbenrolledusers, $stringformat);
			$content .= "<p>$message</p>";
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
	//$q .= " ORDER BY RAND()"; // For debug purposes.
	$q .= " LIMIT 100"; // 100 at a time to spare the geolocation server's life.

	$res = $DB->get_records_sql($q, array());

	$values = array();
	if ($res) {
		foreach ($res as $r) {
			//var_dump($r);
			$url = str_replace('{city}', $r->city, $baseurl);
			$url = str_replace('{country}', $r->country, $baseurl);
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
			$values[] = "(" . $r->id . ", $lat, $lon, $r->city)";
		}
		$valuesstring = implode(',', $values);
		// @TODO if update all, truncate table first or something
		$qins = "INSERT INTO " . $CFG->prefix . "block_usersmap(userid, lat, lon, city) VALUES $valuesstring";
		//var_dump($qins);
		$DB->execute($qins);
	}
}