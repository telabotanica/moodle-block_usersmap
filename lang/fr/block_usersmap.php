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

$string['usersmap:addinstance'] = 'Ajouter un bloc Carte des utilisateurs';
$string['usersmap:myaddinstance'] = 'Ajouter un bloc Carte des utilisateurs à votre Tableau de bord';
$string['pluginname'] = 'Bloc Carte des utilisateurs';
$string['block_usersmap_title'] = 'Carte des utilisateurs';
$string['example_text'] = 'Salut la carte de dingo :)';

$string['geolocation_url_scheme_text'] = 'Schéma d\'url du service de géolocalisation';
$string['geolocation_url_scheme_text_desc'] = 'Le pseudo-champ {{city}} sera remplacé par la ville de l\'utilisateur';

$string['scheduled_task_title'] = 'Mise à jour des coordonnées géographiques des utilisateurs';
$string['scheduled_task_title_all'] = 'Mise à jour des coordonnées géographiques des utilisateurs (TOUS)';
$string['scheduled_task_start_message'] = 'Mise à jour des coordonnées géographiques des utilisateurs !';
$string['scheduled_task_start_message_all'] = 'Mise à jour des coordonnées géographiques des utilisateurs (TOUS)';
