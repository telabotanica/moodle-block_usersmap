# moodle-block_usersmap
A Moodle block that shows a map of users, using Leaflet, Leaflet-markercluster, OpenStreetMap and GeoNames.

Largely inspired by https://github.com/alexlittle/moodle-block_online_users_map

The base map layer can be chosen among OpenStreetMap, Google Satellite (hybrid), Google Streets (plan) or custom tile server (URI scheme).

The geolocation service can be GeoNames (free registration required) or custom (URI scheme).

Each block instance can show (all|online) x (Moodle|enrolled) users, and optionally display the total number of (Moodle&|enrolled) users below.
Users having an activity more recent than 15 minutes are considered online.

English and french versions included / versions anglaise et française incluses.

## continuous integration
[![Build Status](https://travis-ci.org/telabotanica/moodle-block_usersmap.svg?branch=master)](https://travis-ci.org/telabotanica/moodle-block_usersmap)
