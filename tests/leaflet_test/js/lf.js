var map = L.map('map').setView([51.5, -0.09], 15);

// create the tile layer with correct attribution
var OpenStreetMap_Mapnik = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' }).addTo(map);

var markerA = L.marker([51.5, -0.09]).addTo(map);
var markerB = L.marker([52.5170365, 13.3888599]).addTo(map);

markerA.bindPopup("London");
markerB.bindPopup("Berlin");

var PosA = new L.LatLng(51.5, -0.09);
var PosB = new L.LatLng(52.5170365, 13.3888599);
var posList = [PosA, PosB];

var polylineAB = new L.polyline(posList, {

	color: 'green',
	weight: 2,
	opacity: 1,
	smoothFactor: 1

});
polylineAB.addTo(map);