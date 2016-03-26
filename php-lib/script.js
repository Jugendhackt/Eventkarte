function addRouteSegment(el) {
    var a = $("<div class=\"eventkarte-route-segment\"/>");
    a.insertAfter($(el).parent().parent());
    a.load("php-lib/templates/route-segment.php", function(){
            $(a).hide(0).show(500);
    });
}
function removeRouteSegment(el) {
    if($(".eventkarte-route-segment").length > 1) {
        $(el).parent().parent().hide(500, function() {
            $(el).parent().parent().remove();
        });
    } else {
        alert("Das letzte Routenstück kann nicht gelöscht werden");
    }
}
function choseType(el) {
    $(el).parent().find("a").removeClass("selected");
    $(el).addClass("selected");
}
function formIsValid() {
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
    if($("#eventkarte-ownermail").val() == "" || $("#eventkarte-ownername").val() == "") {
        isValid = false;
    }
    return isValid;
}
function generateSegment(el, index) {
    var segment = {};
    segment.freeseats = $(el).find(".eventkarte-free-seats").val();
    segment.type = $(el).find(".eventkarte-route-type a.selected").data("value");
    segment.start = {};
    segment.start.latitude = $(el).find("input.eventkarte-location").data("latitude");
    segment.start.longitude = $(el).find("input.eventkarte-location").data("longitude");

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
    return segment;
}
function insertRoute() {
    checkLocations();
    if(!formIsValid()) {
        alert("Felder ausfüllen");
        return;
    }

    var route = {};
    route.ownermail = $("#eventkarte-ownermail").val();
    route.ownername = $("#eventkarte-ownername").val();
    route.comment   = $("#eventkarte-comment").val();
    route.segments  = Array();

    $(".eventkarte-route-segment").each(function( index ) {
        var segment = generateSegment(this, index);
        route.segments.push(segment);
    });

    //alert(JSON.stringify(route));

    $.ajax({
        type: 'POST',
        data: {"create-route": JSON.stringify(route)},
        url: "php-lib/backend.php"
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
function removeTempMarkers() {
    $.each(map._layers, function (index) {
        console.log(this);
        if (map._layers[index].options.temp) {
            map.removeLayer(this);
        }
    })
}
tempMarker = L.Marker.extend({
    options: {
        temp: true
    }
});
function showMarker(lat, lon, name) {
    removeTempMarkers();
    map.panTo([lat,lon], {animate:true, duration:1});
    setTimeout(function() {
        var grayIcon = L.icon({
            iconUrl: './icons/marker-icon-gray.png',
            shadowUrl: "http://cdn.leafletjs.com/leaflet-0.7.5/images/marker-shadow.png",
            iconAnchor: [14, 41],
            popupAnchor: [0, -33]
        });
        var m = new tempMarker([lat, lon],{icon: grayIcon});
        map.addLayer(m);
        m.bindPopup(name).openPopup();
    },1100);
}
function checkLocation(el) {
    if($(el).val() == $(el).data("last-check") ||
       $(el).attr("id") == "eventkarte-location-destination") {
        // Do not check again
        return;
    }
    var townName = $(el).val();
    if(townName == "") {
        $(el).css("background", "#fff");
        return;
    }
    $.ajax({
        type: 'GET',
        async: true,
        url: "http://nominatim.openstreetmap.org/search/" 
                + encodeURI(townName) + "?format=json"
    }).success(function( data ) {
        if(data[0] == undefined) {
            removeTempMarkers();
            $(el).data("latitude", "");
            $(el).data("longitude", "");
            $(el).data("last-check", $(el).val());
            $(el).css("background", "#faa");
        } else {
            $(el).data("latitude", data[0].lat);
            $(el).data("longitude", data[0].lon);
            $(el).data("last-check", $(el).val());
            $(el).css("background","#aaffaa");
            showMarker(data[0].lat, data[0].lon, data[0].display_name);
        }
    }).error(function( ) {
        removeTempMarkers();
        $(el).data("latitude", "");
        $(el).data("longitude", "");
        $(el).data("last-check", $(el).val());
        $(el).css("background", ($(el).val() == "") ? "#fff" : "#faa");
    });
}
function checkLocations() {
    $("input.eventkarte-location").each(function( index ) {
        checkLocation(this);
    });
}
function contact(segment_id, name) {
    $("#eventkarte-mail-receiver").text(name);
    $("#eventkarte-receiver_segment").val(segment_id);
    $("#eventkarte-contact input").val("");
    $("#eventkarte-contact textarea").val("");
    $("#eventkarte-contact").show(500);
    $('html, body').animate({
        scrollTop: $("#eventkarte-contact").offset().top
    }, 1500);
}

function sendMail() {
    var post = {};
    post.sendmail = $("#eventkarte-receiver_segment").val();
    post.sender_mail = $("#eventkarte-sendermail").val();
    post.sender_name = $("#eventkarte-sendername").val();
    post.text = $("#eventkarte-contact textarea").val();

    $.ajax({
        type: 'POST',
        async: false,
        data: post ,
        url: "php-lib/backend.php"
    }).success(function( data ) {
        if(data=="") {
            alert("Gesendet");
            $("#eventkarte-contact").hide(500);
        } else {
            alert(data);
        }
    }).error(function( ) {
        alert("Error");
    });
}

$(document).ready(function() {
    setInterval(checkLocations, 2000);
});


