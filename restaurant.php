<?php
//GOOGLE MAPS API KEY
//AIzaSyAPcOg71QtU3scPX_jJSIKfqyBJvgrXtrI-->

require_once "includes/header.php";
require_once "Restaurants.php";
require_once "database.php";
require_once "Comment.php";

$db = Database::getDb();
$comment = new Comment();

if(isset($_POST['resid'])){
	//echo 'resid is ' . $_POST['resid'];
	$id = $_POST['resid'];
	echo date('m/d/Y h:i:s');
	
	$restaurants = new Restaurants();
	$restaurantdata = $restaurants->getRestaurantById($id);
	$restaurantdata = JSON_DECODE($restaurantdata, true);
	//echo 'Restaurant title: ' . $restaurantdata['name'] . '<br><br><br>';
	//print_r($restaurantdata);
	
	$latitude = $restaurantdata ['location']['latitude'];
	$longitude = $restaurantdata['location']['longitude'];
	
	
} else {
	header("Location: index.php");
}

//If comment submit form was sent
if(isset($_POST['name'])){
	
	$name = $_POST['name'];
	$content = $_POST['content'];
	$emptyvalerror = false;
	
	//Make sure name and content are not empty or null
	if(validate($_POST['name'])){
		$emptyvalerror = 'Name is required.';
	} else if(validate($_POST['content'])) {
		$emptyvalerror = 'Content is required.';
	} else {
		//Add the comment to the db
		//restaurant id: $id
		$name = $_POST['name'];
		$content = $_POST['content'];
		$count = $comment->addComment($db, $id, $name, $content);
		
	}
}

function validate($val){
	if(   ($val=='')   ||   ($val==null)   ){
		return true;//Empty or null
	}
	return false;//Not empty or null
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
	<div id="hidden__latitude" style="display:none"><?php echo $latitude; ?></div>
	<div id="hidden__longitude" style="display:none"><?php echo $longitude; ?></div>
	
	<div id="result">
		<!--<p>ID: <?php echo $id; ?></p>-->
		<h1><p>Welcome to: <?php echo $restaurantdata['name']; ?></p></h1><hr>
		<img src="<?php echo $restaurantdata['featured_image']; ?>" width="700" height="auto">
		<p>Address: <?php echo $restaurantdata['location']['address']; ?></p>
		<!--<p>Lat: <?php echo $restaurantdata ['location']['latitude']; ?></p>
		<p>Lon: <?php echo $restaurantdata ['location']['longitude']; ?></p>-->
		<p>Cuisine: <?php echo $restaurantdata['cuisines']; ?></p>
		<p>Cost for two: <?php echo $restaurantdata['average_cost_for_two']; ?></p>
		<p>User rating: <?php echo $restaurantdata['user_rating']['aggregate_rating'] ?></p><hr>
		
	<div>
	<a href="<?php echo $restaurantdata['url']; ?>"><h3>Click Here To Visit <?php echo $restaurantdata['name']; ?></h3></a>
	</div>
	
	<div id"map"><?php
	$directionsurl = "https://www.google.com/maps/dir//" . $latitude . "," . $longitude;
	?></div>
	<a href="<?php echo $directionsurl; ?>"><h4>Get Directions</h4></a>
	
	<script type="text/javascript" src="map.js"></script>
	
	<div id="map" style="width:500px; height:500px; "></div>
	
	<script async defer src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyCGkcqoinVP-fb9qTDLA6y1Rizy3SLtmKo&callback=initializeMap">
	</script>
	</div>
	
	<!----COMMENT FEATURE---->
	<?php
	//$db = Database::getDb();
	$comments = $comment->getAllComments($db, $id);
	echo '<h2>' . count($comments) . ' Comments</h2>';
	//Submit a comment
	if(isset($emptyvalerror)){ 
		echo '<div id="error" style="color:red;">' . $emptyvalerror . '</div>';
	}?>
	
	<form action="restaurant.php" method="post">
		<input type="hidden" name="resid" value="<?php echo $id; ?>">
		<div>
			<label for="name">Your name: </label>
			<input type="text" name="name">
		</div>
		<div>
			<label for="content">Your comment:</label>
			<input type="text" name="content">
		</div>
		<div>
			<input type="submit" name="submit" value="OK">
		</div>
	</form>
	
	<?php
	//List of comments
	foreach($comments as $c){
		echo '<div class="comment" style="border:1px solid black;">';
		echo '<div class="comment__nametime">' .
		$c->username . ' | ' . $c->comment_time . '</div>';
		echo '<div class="comment__content">' . $c->comment_content;
		echo '</div></div>';
	}
	?>
	</div>
</body>