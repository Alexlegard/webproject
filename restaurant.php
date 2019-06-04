<?php
//GOOGLE MAPS API KEY
//AIzaSyAPcOg71QtU3scPX_jJSIKfqyBJvgrXtrI-->

require_once "includes/header.php";
require_once "Restaurants.php";

if(isset($_POST['resid'])){
	//echo 'resid is ' . $_POST['resid'];
	$id = $_POST['resid'];
	$restaurants = new Restaurants();
	$restaurantdata = $restaurants->getRestaurantById($id);
	$restaurantdata = JSON_DECODE($restaurantdata, true);
	//echo 'Restaurant title: ' . $restaurantdata['name'] . '<br><br><br>';
	//print_r($restaurantdata);
} else {
	header("Location: index.php");
}
?>

<body>
	<!--
	Some data we want to include:
	
	Restaurant title
	Featured image
	Location: Address, city, latitude, longitude
	Cuisine (fast food, chinese, etc)
	Average cost for two
	User rating (aggregate rating, votes)
	-->
	<div id="hidden__latitude" style="display:none"><?php echo $restaurantdata ['location']['latitude']; ?></div>
	<div id="hidden__longitude" style="display:none"><?php echo $restaurantdata ['location']['longitude']; ?></div>
	
	<p>Restaurant title: <?php echo $restaurantdata['name']; ?></p>
	<img src="<?php echo $restaurantdata['featured_image']; ?>" width="200" height="auto">
	<p>Address: <?php echo $restaurantdata['location']['address']; ?></p>
	<p>Lat: <?php echo $restaurantdata ['location']['latitude']; ?></p>
	<p>Lon: <?php echo $restaurantdata ['location']['longitude']; ?></p>
	<p>Cuisine: <?php echo $restaurantdata['cuisines']; ?></p>
	<p>Cost for two: <?php echo $restaurantdata['average_cost_for_two']; ?></p>
	<p>User rating: <?php echo $restaurantdata['user_rating']['aggregate_rating'] ?></p>
	
	<script type="text/javascript" src="map.js"></script>
	
	<div id="map" style="width:500px;height:500px;"></div>
	
	<script async defer src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyCGkcqoinVP-fb9qTDLA6y1Rizy3SLtmKo&callback=initializeMap">
	</script>
</body>