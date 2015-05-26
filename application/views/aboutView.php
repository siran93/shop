<style>
	html, body, #map-canvas {
		width: 960px;
		height: 400px;
		margin: 10px auto;
		padding: 0px;
	}
</style>
<script>
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var x;

function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var softcode = new google.maps.LatLng(40.2069, 44.5181);
	var mapOptions = {
		zoom:14,
		center: softcode
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	directionsDisplay.setMap(map);
}

function calcRoute() {
	
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
  	start = position.coords.latitude + ", " + position.coords.longitude;	
  	console.log(start);
	var end = "40.212058,44.569081";
	var request = {
	    origin:start,
	    destination:end,
	    travelMode: google.maps.TravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		}
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

   
<button onclick="calcRoute()" class="roud">Show the roud</button>
<div id="map-canvas"></div>
