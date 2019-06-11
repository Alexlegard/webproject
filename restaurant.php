<?php
//GOOGLE MAPS API KEY
//AIzaSyAPcOg71QtU3scPX_jJSIKfqyBJvgrXtrI-->

session_start();
require_once "includes/header.php";
require_once "Restaurants.php";
require_once "database.php";
require_once "Comment.php";

$db = Database::getDb();
$comment = new Comment();

if(isset($_POST['resid'])){
	//echo 'resid is ' . $_POST['resid'];
	$id = $_POST['resid'];
	
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
if(isset($_POST['content'])){
	
	$name = $_SESSION['name'];
	$content = $_POST['content'];
	$emptyvalerror = false;
	
	//Make sure name and content are not empty or null
	if(validate($_SESSION['name'])){
		$emptyvalerror = 'Name is required.';
	} else if(validate($_POST['content'])) {
		$emptyvalerror = 'Content is required.';
	} else {
		//Add the comment to the db
		//restaurant id: $id
		echo 'name and content are set.';
		$name = $_SESSION['name'];
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
		<h1 id="restaurant-welcome">Welcome to: <?php echo $restaurantdata['name']; ?></h1><hr>
		<img src="<?php echo $restaurantdata['featured_image']; ?>" width="700" height="auto">
		<p>Address: <?php echo $restaurantdata['location']['address']; ?></p>
		<!--<p>Lat: <?php echo $restaurantdata ['location']['latitude']; ?></p>
		<p>Lon: <?php echo $restaurantdata ['location']['longitude']; ?></p>-->
		<p>Cuisine: <?php echo $restaurantdata['cuisines']; ?></p>
		<p>Cost for two: <?php echo $restaurantdata['average_cost_for_two']; ?></p>
		<p>User rating: <?php echo $restaurantdata['user_rating']['aggregate_rating'] ?></p><hr>
		
	<div>
	<a id='affiliate-link' href="<?php echo $restaurantdata['url']; ?>"><h3>Click Here To Visit <?php echo $restaurantdata['name']; ?></h3></a>
	</div>
	
	<div id"map"><?php
	$directionsurl = "https://www.google.com/maps/dir//" . $latitude . "," . $longitude;
	?></div>
	<a id="directions-link" href="<?php echo $directionsurl; ?>"><h4>Get Directions</h4></a>
	
	<script type="text/javascript" src="map.js"></script>
	
	<div id="map" style="width:500px; height:500px; "></div>
	
	<script async defer src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyCGkcqoinVP-fb9qTDLA6y1Rizy3SLtmKo&callback=initializeMap">
	</script>
	
	
	<!----COMMENT FEATURE---->
	<?php
	//$db = Database::getDb();
	$comments = $comment->getAllComments($db, $id);
	//var_dump($comments);
	echo '<h4 id="comments-header">' . count($comments) . ' Comments</h4>';
	//Submit a comment
	if(isset($emptyvalerror)){ 
		echo '<div id="error" style="color:red;">' . $emptyvalerror . '</div>';
	} 
	if(isset($_SESSION['name'])){
	?>
	<form action="restaurant.php" method="post">
		<input type="hidden" name="resid" value="<?php echo $id; ?>">
		<div>
			<label for="content"><p>Your comment:</p></label>
			<input type="text" name="content">
		<input type="submit" name="submit" value="OK">
		</div>
	</form>
	<?php
	} else {
		echo '<p><a href="login.php">Sign in to comment!</a></p>';
	}
	//List of comments
	foreach($comments as $c){
		echo '<div class="comment" style="border:1px solid black;">';
		echo '<div class="comment__nametime"><p>' .
		$c->username . ' | ' . $c->comment_time . '</p></div>';
		echo '<div class="comment__content"><p>' . $c->comment_content;
		echo '</p></div></div>';
	}
	?>
	</div>
	<?php
require_once "includes/footer.php";