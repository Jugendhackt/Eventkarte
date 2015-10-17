function addRouteSegment(el) {
	var a = $("<div class=\"eventkarte-route-segment\"/>");
	a.insertAfter($(el).parent());
	a.load(EVENTKARTE_LIB_URL + "/templates/route-segment.php");
	//TODO: Animate
}
function choseType(el) {
	$(el).parent().find("a").removeClass("selected");
	$(el).addClass("selected");
}
function insertRoute() {
	checkLocations();

	var isValid = true;
	$("input.eventkarte-location").each(function( index ) {
		var el = $(this);
		if($(el).attr("id") == "eventkarte-location-destination") {
			return;
		}
		if($(el).val() != $(el).data("last-check")) {
			isValid = false;
		}
		if($(el).data("latitude") == "") {
			isValid = false;
		}
	});
	if(!isValid) {
		alert("Felder ausfüllen");
		return;
	}

	//TODO: Validation

	var route = {};
	route.ownermail = $("#eventkarte-ownermail").val();
	route.ownername = $("#eventkarte-ownername").val();
	route.comment   = $("#eventkarte-comment").val();
	route.segments  = Array();

	var last_location = null;
	$(".eventkarte-route-segment").each(function( index ) {

		var segment = {};
		segment.freeseats = $(this).find(".eventkarte-free-seats").val();
		segment.type = $(this).find(".eventkarte-route-type a.selected").data("value");
		segment.start = {};
		segment.start.latitude = $(this).find("input.eventkarte-location").data("latitude");
		segment.start.longitude = $(this).find("input.eventkarte-location").data("longitude");

		if(index+1 == $(".eventkarte-route-segment").length) {
			segment.end = EVENTKARTE_EVENT_POSITION;
		} else {
			var next = $(".eventkarte-route-segment")[index+1];
			segment.end = {};
			segment.end.latitude = $(next).find("input.eventkarte-location").data("latitude");
			segment.end.longitude = $(next).find("input.eventkarte-location").data("longitude");
		}

		segment.time = "";
		segment.free_seats = 0;
		route.segments.push(segment);
	});

	//alert(JSON.stringify(route));

	$.ajax({
      type: 'POST',
      data: { "create-route": JSON.stringify(route) } ,
	  url: EVENTKARTE_LIB_URL + "/backend.php",
	}).success(function( data ) {
		if(data != "") {
			alert(data);
		} else {
			alert("Gespeichert");
			window.location.reload();
		}
	}).error(function( ) {
		alert("Error");
	});
}

function checkLocations() {
	$("input.eventkarte-location").each(function( index ) {
		var el = $(this);
		if($(el).val() == $(el).data("last-check")) {
			// Do not check again
			return;
		}
		if($(el).val() == "") {
			return;
		}
		if($(el).attr("id") == "eventkarte-location-destination") {
			return;
		}

		$.ajax({
		  type: 'GET',
          async: false,
		  data: { "get-gps": $(el).val() } ,
		  url: EVENTKARTE_LIB_URL + "/backend.php",
		}).success(function( data ) {
			$(el).data("latitude", data.lat);
			$(el).data("longitude", data.lon);
			$(el).data("last-check", $(el).val());
			$(el).css("background","#aaffaa");
		}).error(function( ) {
			$(el).data("latitude", "");
			$(el).data("longitude", "");
			$(el).css("background","#ffaaaa");
		});

	});
}

$(document).ready(function() {
    setInterval(checkLocations, 2000);
});

$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 20) {
        $('h1').addClass('scroll');
    } else {
        $('h1').removeClass('scroll');
    }
});


