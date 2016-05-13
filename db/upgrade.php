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
 
function xmldb_block_usersmap_upgrade($oldversion) {
    global $DB;

    $result = true;
	$dbman = $DB->get_manager();

    if ($oldversion < 2016051303) {

        // Define table block_usersmap to be created.
        $table = new xmldb_table('block_usersmap');

        // Adding fields to table block_usersmap.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, null, null);
        $table->add_field('lat', XMLDB_TYPE_NUMBER, '15, 12', null, null, null, null);
        $table->add_field('lon', XMLDB_TYPE_NUMBER, '15, 12', null, null, null, null);

        // Adding keys to table block_usersmap.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('userid', XMLDB_KEY_FOREIGN_UNIQUE, array('userid'), 'users', array('id'));

        // Conditionally launch create table for block_usersmap.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Usersmap savepoint reached.
        upgrade_block_savepoint(true, 2016051303, 'usersmap');
    }

    return $result;
}
