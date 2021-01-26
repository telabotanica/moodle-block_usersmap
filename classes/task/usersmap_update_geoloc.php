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

namespace block_usersmap\task;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/blocks/usersmap/lib.php');

/**
 * Updates geolocation for users having none yet, and stores the coordinates
 * into block_usersmap table (to be executed regularly, for ex. daily)
 */
class usersmap_update_geoloc extends \core\task\scheduled_task {

    public function get_name() {
        // Shown in admin screens.
        return get_string('scheduled_task_title', 'block_usersmap');
    }

    public function execute() {
        echo get_string('scheduled_task_start_message', 'block_usersmap') . PHP_EOL;
        usersmap_update_geolocation(false); // Update only for users having no geolocation yet.
    }
}

/**
 * Updates geolocation for ALL users, and stores the coordinates into
 * block_usersmap table (to be executed less frequently, for ex. monthly)
 */
class usersmap_update_geoloc_all extends \core\task\scheduled_task {

    public function get_name() {
        // Shown in admin screens.
        return get_string('scheduled_task_title_all', 'block_usersmap');
    }

    public function execute() {
        echo get_string('scheduled_task_start_message_all', 'block_usersmap') . PHP_EOL;
        usersmap_update_geolocation(true); // Update for all users.
    }
}