<?php

include_once('connect.php');


?>
<head>
	
<script>
function myMap() {
    var locations = [['Greenbelt', 4, 14.5541, 121.0189]];
    iw = new google.maps.InfoWindow();
	var geneve = new google.maps.LatLng(12.8797, 121.7740);

    var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 5,
		scrollwheel: false,
		center: new google.maps.LatLng(0.0, 0.0),
		mapTypeId : google.maps.MapTypeId.ROADMAP, // Type de carte, diff�rentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
		streetViewControl: false,
		center: geneve,
		panControl: false,
		zoomControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		}
    });
	var inputLocation = /** @type {HTMLInputElement} */(document.getElementById('pac-input'));
	// Link it to the UI element.
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputLocation);
	var autocompleteLocation = new google.maps.places.Autocomplete(inputLocation);
	autocompleteLocation.bindTo('bounds', map);
	 /******************** LISTENER ************************/
	google.maps.event.addListener(autocompleteLocation, 'place_changed', function() {
	inputLocation.className = '';
	var placeStart = autocompleteLocation.getPlace();
	if (!placeStart.geometry) {
	  // Inform the user that the place was not found and return.
	  inputLocation.className = 'notfound';
	  return;
	}

	 
	// If the place has a geometry, then present it on a map.
	if (placeStart.geometry.viewport) {
	  map.fitBounds(placeStart.geometry.viewport);
	} else {
	  map.setCenter(placeStart.geometry.location);
	  map.setZoom(13);  // Why 13? Because it looks good.
	}
	var address = '';
	if (placeStart.address_components) {
	  address = [
		(placeStart.address_components[0] && placeStart.address_components[0].short_name || ''),
		(placeStart.address_components[1] && placeStart.address_components[1].short_name || ''),
		(placeStart.address_components[2] && placeStart.address_components[2].short_name || '')
	  ].join(' ');
	}
  });
  /******************** END LISTENER ************************/
    var marker, i;
	var contentDiv = '';

    for (i = 0; i < locations.length; i++) {  
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][2], locations[i][3]),
			map: map,
			title: locations[i][0]+ " (" + locations[i][1] + " stars)"
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			var selectedname = locations[i][0];
			marker.setAnimation(google.maps.Animation.BOUNCE);
			stopAnimation(marker);
			$.ajax({
			success: function(data) {
			iw.open(map, marker);					
			iw.setContent("<button id='chart' onCLick='showChart()'>" + locations[i][0] + " Branch</button>");				
			}
				
			});
				return false;
			};
        })
	    (marker, i));
    }
	
	google.maps.event.addListener(iw, 'closeclick', function() {  
		
	}); 
	
	function stopAnimation(marker) {
		setTimeout(function () {
			marker.setAnimation(null);
		}, 3000);
	}
}

$('#pan1').hide();


</script>
</head>
<body>
<div class="row">
<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading bg-semiblue">
	<h3><span class='glyphicon glyphicon-map-marker' style='color: #F00;'></span> SITE LOCATIONS</h3>
			</div>
			
			<div id="map" class="panel-body" style=" height: 400px; padding: 0 !important;"></div>
		</div>
	</div>
<!-- chart -->				
<div class="col-md-4" id="pan1">
	<div class="panel panel-default" style=" height: 400px; padding: 0 !important;">
		<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-shopping-bag fa-fw"></i> Greenbelt</h3>
		</div>
		<center>
	<div id="pie4" class="panel-body" style="min-width: 400px; height: 350px; margin: 0 auto"></div>
		</center>
		</div>
	</div>
</div>
</body>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC2AilVLipxetunhcxHM4U1Pc-hm7Fy-U8&libraries=places&callback=myMap"></script>
<script>
function showChart(){
$('#chart').click(function() {
$('#pan1').show();	
});
}
		
</script>

