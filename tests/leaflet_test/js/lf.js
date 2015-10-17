$(document).ready(function(){
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
		weight: 10,
		opacity: 1,
		smoothFactor: 1

	});
	polylineAB.addTo(map);
	

	$.getJSON( "js/data.json", function( data ) {
		
		
		var latC = data[0].segments[0].start.latitude;
		var lngC = data[0].segments[0].start.longitude;
		var PosC = new L.LatLng(latC, lngC);		
		var markerC = L.marker(PosC).addTo(map);
		markerC.bindPopup("Marker C");
		
		var latD = data[0].segments[0].end.latitude;
		var lngD = data[0].segments[0].end.longitude;
		var PosD = new L.LatLng(latD, lngD);			
		var markerD = L.marker(PosD).addTo(map);
		markerD.bindPopup("Marker D");

		var posListCD = [PosC, PosD];

		var polylineCD = new L.polyline(posListCD, {

		color: 'pink',
		weight: 10,
		opacity: 1,
		smoothFactor: 1

		
		});
		polylineCD.addTo(map);
	});
	
});

