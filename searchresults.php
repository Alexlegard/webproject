<!--
My Zomato API key: a320bb8bf44e39927b15ff6510601376

To do:
-Search the restaurants according to relevance using $_POST['search__query']
-Create a restaurant info page
-->
<!--EXAMPLE QUERY STRING FOR CHINESE IN TORONTO
https://developers.zomato.com/api/v2.1/search?entity_id=89&entity_type=city&q=Chinese&count=12
-->
<?php



require_once 'includes/header.php';
require_once 'Restaurants.php';

if(isset($_GET['city'])){
	$city = $_GET['city'];
}

if(isset($_POST['search__city'])){
	
	if(isset($_POST['page'])){
		if(isset($_POST['next'])){
			$page = $_POST['page']+1;
		}
		if(isset($_POST['prev'])){
			$page = $_POST['page']-1;
		}
	} else {
		$page = 1;
	}
	
	$city = $_POST['search__city'];
	$query = $_POST['search__query'];
	
	$restaurants = new Restaurants();
	//Change number of search results per page
	$nr = 12;
	
	$locationquery = $restaurants->getDebugLocationQuery($city);//Debug
	$locationdata = $restaurants->getLocationData($city);
	$locationdata = json_decode($locationdata, true);
	$entityid = $locationdata['location_suggestions'][0]['entity_id'];
	
	
	//Finally create the search data and put it in a variable
	$searchquery = $restaurants->getDebugSearchQuery($entityid, $nr, $page);//Debug
	$searchdata = $restaurants->getSearchData($entityid, $nr, $page, $query);
	$searchdata = json_decode($searchdata, true);
	$searchdata = $searchdata['restaurants'];
	
} else {
	header("Location: index.php");
}?>

    <!-- <header class="masthead" style="background-image:url('assets/img/header-bg.gif');"> -->

	<body>
	<div class="container">
		<div class="row mb-4 mt-2">
			<h1>Searching for Restaurants in <?php echo $city; ?></h1>
			
			<!--Pagination-->
			<form method="post" action="searchresults.php">
				<?php echo "Page " . $page; ?>
				<input type="hidden" name="search__city" value="<?php echo $city; ?>">
				<input type="hidden" name="page" value="<?php echo $page; ?>">
				<input type="submit" name="prev" value="Prev">
				<input type="submit" name="next" value="Next">
			</form>
		
		<?php
		
		foreach($searchdata as $item){
			
			$resid = $item['restaurant']['R']['res_id'];
				
			if($item['restaurant']['featured_image'] == ''){
				$imageurl = '/assets/img/NotFound.jpg';
			} else {
				$imageurl = $item['restaurant']['featured_image'];
			}
			//echo 'Image url ' . $imageurl;
			//<input type='image' src='../images/blanc.gif' width='596' height='35'     onFocus='form.submit' name='btn_opentextbox'/>
			echo '<div class="col-lg-4 mb-2 line-content">';
			//echo '<p>' . $item['restaurant']['featured_image'];
			echo '<form method="post" action="restaurant.php">';
			echo '<input type="hidden" name="resid" value="' . $resid . '">';
			echo '<label>' . $item['restaurant']['name'] . '</label><br>';
			echo '<input type="image" src="'.$imageurl.'" width="200" height="auto" onFocus="submit" name="restaurant_img" value="ok">';
			echo '</form></div>';
			
		}
		?>
		
		</div>
    </div>
	</body>
</html>
	
    </div>
	</div>
	
	<?php
		require_once 'includes/footer.php';	
	?>
</html>