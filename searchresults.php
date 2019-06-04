<!--
My Zamato API key: a320bb8bf44e39927b15ff6510601376

To do:
-Search the restaurants according to relevance using $_POST['search__query']
-Create a restaurant info page
-->

<?php

require_once 'includes/header.php';
require_once 'Restaurants.php';


if(isset($_POST['search__city'])){
	
	//For the city Brampton, I need to fetch the entity ID
	//and the entity type.
	$city = $_POST['search__city'];
	$restaurants = new Restaurants();
	//Change number of search results per page
	$restaurants->setNumResults(10);
	
	//Fetch json for the location suggestions
	$restaurants->setLocationData($city);
	$locationdata = $restaurants->locationdata;
	$locationdata = json_decode($locationdata, true);
	//TO PRINT LOCATION DATA DETAILS:
	//print_r($locationdata);
	//echo '<br><br><br>';
	$entityid = $locationdata['location_suggestions'][0]['entity_id'];
	//echo 'City entity id: ' . $entityid;
	//Finally, set the class entity id
	$restaurants->setEntityId($entityid);
	
	//Now call set data function
	$restaurants->setSearchData();
	$searchdata = $restaurants->searchdata;
	$searchdata = json_decode($searchdata, true);
	$searchdata = $searchdata['restaurants'];
	//print_r($searchdata['restaurants'][0]['restaurant']['name']);
	//print_r($searchdata);
}?>

    <!-- <header class="masthead" style="background-image:url('assets/img/header-bg.gif');"> -->

	<body>
	
	<div class="container">
    <div class="row mb-4 mt-2">
		<h1>Searching for Restaurants in <?php echo $city; ?></h1>
	</body>
	
	<?php
	//$searchdata is a json_decode object
	
	foreach($searchdata as $item){
		echo '<div class="col-lg-4 mb-2 line-content">' . $item['restaurant']['name'];
		// echo '<br>Address: ' . $item['restaurant']['location']['address'];
		// echo '<br>City: ' . $item['restaurant']['location']['city'];
		// echo '<br>User rating: ' . $item['restaurant']['user_rating']['aggregate_rating'];
		echo '<br><img src=' .
		$item['restaurant']['featured_image'] .
		' width=200 height=auto>';
		echo '<br><br><br></div>';
		
	}
	?>
	
    </div>
	</div>
	
	<?php

		require_once 'includes/footer.php';
		
	?>
</html>

