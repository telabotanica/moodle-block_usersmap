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
 * Block definition
 *
 * @package    block_usersmap
 * @copyright  2016 Mathias Chouet, Tela Botanica
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_usersmap_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

		// Display users count
		$mform->addElement('advcheckbox', 'config_displaynbmoodleusers', get_string('config_display_nb_moodle_users', 'block_usersmap'), '', null, array(0, 1));
		$mform->setDefault('config_displaynbmoodleusers', 0);
		$mform->setType('config_displaynbmoodleusers', PARAM_RAW);

		$mform->addElement('advcheckbox', 'config_displaynbenrolledusers', get_string('config_display_nb_enrolled_users', 'block_usersmap'), '', null, array(0, 1));
		$mform->setDefault('config_displaynbenrolledusers', 1);
		$mform->setType('config_displaynbenrolledusers', PARAM_RAW);
    }
}
