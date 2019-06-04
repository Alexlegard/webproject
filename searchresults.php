<!--
My Zamato API key: a320bb8bf44e39927b15ff6510601376

To do:
-Search the restaurants according to relevance using $_POST['search__query']
-Create a restaurant info page
-->

<?php

require_once 'includes/header.php';
require_once 'Restaurants.php';

if(isset($_GET['city'])){
	$city = $_GET['city'];
}

if(isset($_POST['search__city'])){
	
	//$searchdata = showResults(12);
	
	//For the city Brampton, I need to fetch the entity ID
	//and the entity type.
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
	//Somehow take the $page and 
	
	$city = $_POST['search__city'];
	$restaurants = new Restaurants();
	//Change number of search results per page
	$nr = 12;
	//SET NUMRESULTS
	$restaurants->setNumResults($nr);
	//SET LOCATION DATA and put it in a variable. Use that variable to find the city id
	$restaurants->setLocationData($city);
	$locationdata = $restaurants->locationdata;
	$locationdata = json_decode($locationdata, true);
	$entityid = $locationdata['location_suggestions'][0]['entity_id'];
	//SET THE CITY ID
	$restaurants->setEntityId($entityid);
	//SET THE PAGINATION PAGE
	$restaurants->setPage($page);
	//Finally create the search data and put it in a variable
	$restaurants->setSearchData();
	$searchdata = $restaurants->searchdata;
	$searchdata = json_decode($searchdata, true);
	$searchdata = $searchdata['restaurants'];
	//return $searchdata;
	//print_r($searchdata['restaurants'][0]['restaurant']['name']);
	
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
				<!--
				<input type="hidden" name="city" value="<?php //echo $_POST['search__city']; ?>">
				<!--<input type="hidden" name="page" value="<?php //if(isset($_GET['page'])){ echo $_GET['page']; }else { echo "1"; } ?>">-->
				<!--<input type="submit" name="page" value="<?php //if(isset($_GET['page'])){ $page=$_GET['page']-1; echo $page; }else{ echo "0"; } ?>">
				<input type="submit" name="page" value="<?php //if(isset($_GET['page'])){ $page=$_GET['page']+1; echo $page; }else{ echo "2"; } ?>">-->
			</form>
		
		
		<img src=>
		<?php
		//$searchdata is a json_decode object
		
		//print_r($searchdata);
		
		foreach($searchdata as $item){
			
			$resid = $item['restaurant']['R']['res_id'];
			//<input type='image' src='../images/blanc.gif' width='596' height='35'     onFocus='form.submit' name='btn_opentextbox'/>
			echo '<div class="col-lg-4 mb-2 line-content">';
			echo '<form method="post" action="restaurant.php">';
			echo '<input type="hidden" name="resid" value="' . $resid . '">';
			echo '<label>' . $item['restaurant']['name'] . '</label>';
			echo '<input type="image" src="'.$item['restaurant']['featured_image'].'" width="200" height="auto" onFocus="submit" name="restaurant_img" value="ok">';
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