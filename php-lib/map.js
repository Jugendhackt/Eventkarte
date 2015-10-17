
	
$(document).ready(function(){

	function drawSegment(segment, ownername, comment, first)
	{
			
		var PosA = new L.LatLng(segment.start.latitude, segment.start.longitude);
		var PosB = new L.LatLng(segment.end.latitude, segment.end.longitude);			

		var posListAB = [PosA, PosB];

		var polylineAB = new L.polyline(posListAB, {
			color: getSegmentColor(segment.type),
			weight: 8,
			opacity: 1,
			smoothFactor: 1
		});
		polylineAB.on('mousein', function(e) {
    		this.weight=20;
		});
		polylineAB.addTo(map);
		
		polylineAB.bindPopup("<b>Name: </b>" + ownername + " (<a onclick=\"contact("+segment.id+",'"+ownername+"');\" href=\"#\">Kontakt</a>)<br><b>Freie Sitzpl\u00e4tze: </b>" + segment.free_seats + "<br><b>Bemerkung: </b>" + comment);
	}
	function setMarkerForRoute(route){
		var Pos = new L.LatLng(route.segments[0].start.latitude, route.segments[0].start.longitude);
		var markerA = L.marker(Pos).addTo(map);
	}
	function drawRoute(route){
		var ownername = route.ownername
		var comment = route.comment
		var first = true;
			$.each(route.segments,function(index,value){
			drawSegment(value, ownername, comment, first)
		});
	}
	var map = L.map('map').setView([EVENTKARTE_EVENT_POSITION.latitude, EVENTKARTE_EVENT_POSITION.longitude], 7);

	// create the tile layer with correct attribution
	var OpenStreetMap_Mapnik = L.tileLayer('http://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png', { maxZoom: 15, minZoom: 5, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' }).addTo(map);
	//Zielpunkt	
	var redIcon = L.icon({
		iconUrl: '../php-lib/icons/marker-icon-jh.png',
		iconAnchor: [14, 41],
	});
	L.marker([EVENTKARTE_EVENT_POSITION.latitude, EVENTKARTE_EVENT_POSITION.longitude],{icon: redIcon}).addTo(map);
	$.getJSON( EVENTKARTE_LIB_URL + "/backend.php?get-routes", function( data ) {
		//alert(data);
		
		$.each(data,function(index,value){
				
				drawRoute(value);
				setMarkerForRoute(value);
		});		
		
	});
	function getSegmentColor(transportType)
	{
		switch(transportType){
		case 0://car
			return '#D4534E';
			break;
		case 1://train
			return '#FFEE00';
			break;
		case 2://ship
			return '#FF9800';
			break;
		case 3://bus
			return '#CDDC39';
			break;
		case 4://bike
			return '#8FB0DC';
			break;
		case 5://plane
			return '#6CABDC';
			break;
		default://ufo
			return '#E91E63';
		}
			
	}
	
});

