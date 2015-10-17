
	
$(document).ready(function(){

	function drawSegment(segment, ownername, comment)
	{
		var PosA = new L.LatLng(segment.start.latitude, segment.start.longitude);		
		var markerA = L.marker(PosA).addTo(map);


		var PosB = new L.LatLng(segment.end.latitude, segment.end.longitude);			
		var markerB = L.marker(PosB).addTo(map);


		var posListAB = [PosA, PosB];

		var polylineAB = new L.polyline(posListAB, {

			color: getSegmentColor(segment,segment.type),
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

	$.getJSON( "http://127.0.0.1/Eventkarte/php-lib/backend.php?get-routes", function( data ) {
		//alert(data);
		$.each(data,function(index,value){
				console.log(value);
				drawRoute(value)
		});		
		
	});
	function getSegmentColor(transportType)
	{
		switch(transportType){
		case 0://car
			return "red";
			break;
		case 1://train
			return "pink";
			break;
		case 2://ship
			return "blue";
			break;
		case 3://bus
			return "yellow";
			break;
		case 4://bike
			return "cyan";
			break;
		case 5://plane
			return "white";
			break;
		default://ufo
			return "green";
		}
			
	}
	
});

