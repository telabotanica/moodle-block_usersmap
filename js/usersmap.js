
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