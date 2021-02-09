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
$string['pluginname'] = 'Carte des utilisateurs';
$string['block_usersmap_title'] = 'Carte des utilisateurs';
$string['example_text'] = 'Salut la carte de dingo :)';

$string['error_tilserver_url_not_set'] = 'Le serveur de tuiles est réglé sur "personnalisé" mais l\'URL du serveur de tuiles n\'est pas définie';

$string['config_display_nb_moodle_users'] = 'Afficher le nombre d\'utilisateurs de Moodle sous la carte';
$string['config_display_nb_enrolled_users'] = 'Afficher le nombre d\'utilisateurs inscrits au cours actuel sous la carte';
$string['config_display_nb_moodle_users_format'] = "Format pour l'affichage du nombre d'utilisateurs de Moodle ({nb} sera remplacé par le nombre)";
$string['config_display_nb_moodle_users_format_default'] = '{nb} Inscrit sur la plateforme';
$string['config_display_nb_moodle_users_format_countriemissing'] = '{nb} Inscrit sur la plateforme ayant indiqué leur pays';
$string['config_display_nb_enrolled_users_format'] = "Format pour l'affichage du nombre d'utilisateurs du cours ({nb} sera remplacé par le nombre)";
$string['config_display_nb_enrolled_users_format_default'] = '{nb} utilisateurs dans ce cours';
$string['config_what_to_display'] = 'Quels utilisateurs afficher sur la carte ?';
$string['config_what_to_display_amu'] = 'Tous les utilisateurs de Moodle';
$string['config_what_to_display_omu'] = 'Tous les utilisateurs de Moodle actuellement en ligne';
$string['config_what_to_display_aeu'] = 'Tous les utilisateurs inscrits au cours';
$string['config_what_to_display_oeu'] = 'Tous les utilisateurs inscrits au cours et actuellement en ligne';

$string['tileserver_url_scheme_text'] = 'Schéma d\'url du serveur de tuiles (fond de carte)';
$string['tileserver_url_scheme_text_desc'] = 'Ne s\'applique qu\'au serveur de tuiles personnalisé. Les pseudo-champs {x}, {y} et {z} seront remplacés par les indices de tuiles et le niveau de zoom';
$string['tileserver_custom'] = 'Personnalisé';
$string['tileserver_select'] = 'Serveur de tuiles';
$string['tileserver_select_desc'] = "Détermine le fond de carte qui sera affiché";
$string['tileserver_max_zoom_text'] = 'Zoom maximal';
$string['tileserver_max_zoom_text_desc'] = "Ne s'applique qu'au serveur de tuiles personnalisé";
$string['tileserver_attribution_text'] = 'Mention légale à indiquer au bas de la carte';
$string['tileserver_attribution_text_desc'] = "Ne s'applique qu'au serveur de tuiles personnalisé";
$string['geolocation_server_select'] = 'Service de géolocalisation';
$string['geolocation_server_select_desc'] = "Détermine le service de géolocalisation qui sera utilisé";
$string['geolocation_url_scheme_text'] = 'Schéma d\'url du service de géolocalisation personnalisé';
$string['geolocation_url_scheme_text_desc'] = 'Ne s\'applique qu\'au service de géolocalisation personnalisé. Les pseudo-champs {city} et {country} seront remplacés par la ville et le pays de l\'utilisateur. Ce service doit retourner des données au format JSON';
$string['geonames_username_text'] = "Nom d'utilisateur GeoNames (requis)";
$string['geonames_username_text_desc'] = "Ne s'applique qu'au service de géolocalisation GeoNames. Se rendre sur http://www.geonames.org pour créer un compte";
$string['geolocation_lat_field_text'] = "Champ dans lequel récupérer la latitude";
$string['geolocation_lat_field_text_desc'] = "Ne s'applique qu'au service de géolocalisation personnalisé. Le champ sera extrait du JSON retourné par le service";
$string['geolocation_lon_field_text'] = "Champ dans lequel récupérer la longitude";
$string['geolocation_lon_field_text_desc'] = "Ne s'applique qu'au service de géolocalisation personnalisé. Le champ sera extrait du JSON retourné par le service";

$string['scheduled_task_title'] = 'Mise à jour des coordonnées géographiques des utilisateurs';
$string['scheduled_task_title_all'] = 'Mise à jour des coordonnées géographiques des utilisateurs (TOUS)';
$string['scheduled_task_start_message'] = 'Mise à jour des coordonnées géographiques des utilisateurs !';
$string['scheduled_task_start_message_all'] = 'Mise à jour des coordonnées géographiques des utilisateurs (TOUS)';

$string['countriesmissing_text'] = 'Autoriser pays manquants';
$string['countriesmissing_text_desc'] = 'Si cette option est coché, le plugin traitera également les données n\'ayant pas de pays défini';