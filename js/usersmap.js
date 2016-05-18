
console.log('coucou la carto de guedin');

var optionsCoucheOSM = {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,'
         + ' <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
},
coucheOSM = new L.TileLayer("http://osm.tela-botanica.org/tuiles/osmfr/{z}/{x}/{y}.png", optionsCoucheOSM);
/*optionsCarte = {
    center : new L.LatLng(46, 2),
    zoom : 6,
    layers : [coucheOSM]
};*/

usersLayer = new L.MarkerClusterGroup({
	disableClusteringAtZoom : 10
});

var usersmap = L.map('usersmap-map').setView([51.505, -0.09], 13);
coucheOSM.addTo(usersmap);
usersLayer.addTo(usersmap);

console.log('carto init fini');