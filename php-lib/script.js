function addRouteSegment(el) {
	var a = $("<div class=\"eventkarte-route-segment\"/>");
	a.insertAfter($(el).parent());
	a.load(EVENTKARTE_LIB_URL + "/templates/route-segment.php");
}
function insertRoute() {
	//TODO: Validation

	var route = {};
	route.ownermail = $("#eventkarte-ownermail").val();
	route.ownername = $("#eventkarte-ownername").val();
	route.comment   = $("#eventkarte-comment").val();
	route.segments  = Array();

	var last_location = null;
	$(".eventkarte-route-segment").each(function( index ) {

		var segment = {};
		segment.start = {};
		segment.start.latitude = $(this).data("latitude");
		segment.start.longitude = $(this).data("longitude");

		if(index+1 == $(".eventkarte-route-segment").length) {
			segment.end = EVENTKARTE_EVENT_POSITION;
		} else {
			var next = $(".eventkarte-route-segment")[index+1];
			segment.end = {};
			segment.end.latitude = $(next).data("latitude");
			segment.end.longitude = $(next).data("longitude");
		}

		segment.time = "";
		segment.free_seats = 0;
		route.segments.push(segment);
	});

	alert(JSON.stringify(route));

	$.ajax({
      type: 'POST',
      data: { "create-route": JSON.stringify(route) } ,
	  url: EVENTKARTE_LIB_URL + "/backend.php",
	}).success(function( data ) {
		alert(data);
	}).error(function( ) {
		alert("Error");
	});
}


