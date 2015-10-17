function addRouteSegment(el) {
	var a = $("<div class=\"eventkarte-route-segment\"/>");
	a.insertAfter($(el).parent());
	a.load(EVENTKARTE_LIB_URL + "/templates/route-segment.html");
}
function insertRoute() {
	//TODO: Validation

	var route = {};
	route.ownermail = $("#eventkarte-ownermail").val();
	route.ownername = $("#eventkarte-ownername").val();
	route.comment   = $("#eventkarte-comment").val();
	route.segments  = Array();

	$(".eventkarte-route-segment").each(function( index ) {

		var segment = {};
		segment.start = {};
		segment.start.latitude = 0;
		segment.start.longitude = 0;
		segment.end = {};
		segment.end.latitude = 0;
		segment.end.longitude = 0;
		segment.time = "";
		segment.free_seats = "";
		route.segmentspush(segment);
	});

	alert(JSON.stringify(route));

	$.ajax({
      type: 'POST',
      data: { "create-route": JSON.stringify(route) } ,
	  url: EVENTKARTE_LIB_URL + "/backend/backend.php",
	}).success(function( data ) {
		alert("OK");
		//TODO: OK
	}).error(function( ) {
		alert("Error");
	});
}
