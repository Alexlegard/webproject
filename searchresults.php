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


session_start();
require_once 'includes/header.php';
require_once 'Restaurants.php';

if(isset($_POST['search__city'])){
	
	if(validate($_POST['search__city'])){
		header("Location: index.php");
	}
	
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
	$results_found = $searchdata['results_found'];
	$results_start = $searchdata['results_start'];
	$results_shown = $searchdata['results_shown'];
	$searchdata = $searchdata['restaurants'];
	
} else {
	header("Location: index.php");
}

function validate($val){
	if(   ($val=='')   ||   ($val==null)   ){
		return true;//Empty or null
	}
	return false;//Not empty or null
}?>

    <!-- <header class="masthead" style="background-image:url('assets/img/header-bg.gif');"> -->

	<body>
	<div class="container">
		<div class="row mb-4 mt-2">
			<h1>Searching for Restaurants in <?php echo $city; ?><br></h1>
			
			<!--Pagination-->
			<?php
				if($results_shown == 0 && $results_found == 0)
				{
			?>
			<h2>No Results found matching your criteria.</h2>
		<?php } ?>

		<?php 
			if (! $results_found < ($results_shown + $results_start)) {
		?>
			<form id="page" method="post" action="searchresults.php">
				<?php echo "Page " . $page; ?>
				<input type="hidden" name="search__city" value="<?php echo $city; ?>">
				<input type="hidden" name="search__query" value="<?php echo $query; ?>">
				<input type="hidden" name="page" value="<?php echo $page; ?>">
				<input type="submit" name="prev" value="Prev">
				<input type="submit" name="next" value="Next">
			</form>
		
		<?php 
			}
		?>
		<?php ?>
		
		<?php
		
		foreach($searchdata as $item){
			
			$resid = $item['restaurant']['R']['res_id'];
				
			if($item['restaurant']['featured_image'] == ''){
				?><script>//alert("Inside if");</script><?php
				$imageurl = 'assets/img/NotFound.jpg';
			} else {
				$imageurl = $item['restaurant']['featured_image'];
			}
			//echo 'Image url ' . $imageurl;
			//<input type='image' src='../images/blanc.gif' width='596' height='35'     onFocus='form.submit' name='btn_opentextbox'/>
			echo '<div id="search" class="col-lg-6 mb-2 line-content">';
			//echo '<p>' . $item['restaurant']['featured_image'];
			echo '<div><form method="post" action="restaurant.php">';
			echo '<input type="hidden" name="resid" value="' . $resid . '">';
			echo '<h4><label>' . $item['restaurant']['name'] . '</label><h4><br>';
			echo '<input id="display" type="image" src="'.$imageurl.'" width="480" height=300" onFocus="submit" name="restaurant_img" value="ok"><br><br>';
			echo '</form></div></div>';
			
		}
		?>
		
		</div>
		</div>
				<?php 
			if (! $results_found < ($results_shown + $results_start)) {
		?>
		<!--Pagination-->
		<form id="pageb" method="post" action="searchresults.php">
				<?php echo "Page " . $page; ?>
				<input type="hidden" name="search__city" value="<?php echo $city; ?>">
				<input type="hidden" name="search__query" value="<?php echo $query; ?>">
				<input type="hidden" name="page" value="<?php echo $page; ?>">
				<input type="submit" name="prev" value="Prev">
				<input type="submit" name="next" value="Next">
			</form>

		<?php }?>
    </div>
	</body>
</html>
	
    </div>
	</div>
	
	<?php
		require_once 'includes/footer.php';	
	?>
</html>