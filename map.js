function initializeMap(){
	
	//Get latitude and longitude from hidden div
	var latitude = parseFloat(document.getElementById("hidden__latitude").innerHTML);
	
	var longitude = parseFloat(document.getElementById("hidden__longitude").innerHTML);
	
	var restaurant = {
		lat: latitude,
		lng: longitude
		//lat: 43.6550972222,
		//lng: -79.3864055556
	};
	
	var restaurantMap = new google.maps.Map(
		document.getElementById('map'),
		{
			center: restaurant,
			map: restaurantMap
		}
	);
	var map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: restaurant});
	var marker = new google.maps.Marker({ position:restaurant, map:map });
}