<!--
My Zamato API key: a320bb8bf44e39927b15ff6510601376
-->

<?php
require_once 'Restaurants.php';

if(isset($_POST['search__city'])){
	
	//For the city Brampton, I need to fetch the entity ID
	//and the entity type.
	$city = $_POST['search__city'];
	$restaurants = new Restaurants();
	//Change number of search results per page
	$restaurants->setNumResults(2);
	echo 'Num results: ' . $restaurants->getNumResults() . "<br>";
	echo 'City: ' . $city;
	
	//Fetch json for the location suggestions
	$restaurants->setLocationData($city);
	$locationdata = $restaurants->locationdata;
	$locationdata = json_decode($locationdata, true);
	//TO PRINT LOCATION DATA DETAILS:
	//print_r($locationdata);
	echo '<br><br><br>';
	$entityid = $locationdata['location_suggestions'][0]['entity_id'];
	echo 'City entity id: ' . $entityid;
	//Finally, set the class entity id
	$restaurants->setEntityId($entityid);
	
	//Now call set data function
	$restaurants->setSearchData();
	$searchdata = $restaurants->searchdata;
	$searchdata = json_decode($searchdata, true);
	echo '<br><br><br>Search data:<br>';
	print_r($searchdata);
}?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Searching for Grub</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<h1>Searching for Restaurants in <?php echo $city; ?></h1>
	</body>
</html>