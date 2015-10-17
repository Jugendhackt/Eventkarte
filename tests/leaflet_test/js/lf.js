
	
$(document).ready(function(){

	function drawSegment(segment, ownername, comment)
	{
		var PosA = new L.LatLng(segment.start.latitude, segment.start.longitude);		
		var markerA = L.marker(PosA).addTo(map);


		var PosB = new L.LatLng(segment.end.latitude, segment.end.longitude);			
		var markerB = L.marker(PosB).addTo(map);


		var posListAB = [PosA, PosB];

		var polylineAB = new L.polyline(posListAB, {

			color: 'pink',
			weight: 10,
			opacity: 1,
			smoothFactor: 1
		});
		polylineAB.addTo(map);
		
		polylineAB.bindPopup("<b>Name: </b>" + ownername + "<br><b>Freie Sitzpl\u00e4tze: </b>" + segment.free_seats + "<br><b>Bemerkung: </b>" + comment);
		

	}
	function drawRoute(route){
		var ownername = route.ownername
		var comment = route.comment
			$.each(route.segments,function(index,value){
				//console.log(value);
			drawSegment(value, ownername, comment)
		});
	}
	var map = L.map('map').setView([51.5, -0.09], 15);

	// create the tile layer with correct attribution
	var OpenStreetMap_Mapnik = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' }).addTo(map);
/*
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
*/
	$.getJSON( "js/data.json", function( data ) {
		//alert(data);
		$.each(data,function(index,value){
				console.log(value);
				drawRoute(value)
		});		
		//drawRoute(data[0]);
		
	});
	
});

