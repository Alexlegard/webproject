<?php
session_start();
require_once "includes/header.php";
?>
<script type="text/javascript">
function validateSearchForm(){
	
	city = document.getElementById("search__city").value;
	
	if(city === ""){
		alert("City is required.");
		document.getElementById("search__city").focus();
		return false;
	} else {
		return true;
	}
}	
</script>
    <header class="masthead" style="background-image:url('assets/img/header-bg.gif');">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in"><span>Hungry?</span></div>
                <div class="intro-heading text-uppercase"><span style="font-family: 'Kaushan Script', cursive;">Find Grub!</span></div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <form action="searchresults.php" method="post" onsubmit="return validateSearchForm();">
                    <div class="form-group" id="city">
                        <!-- <label for="city">City</label> -->
                        <input class="form-control" id="search__city" name="search__city" type="text" placeholder="Enter City">
                        <span class="show-error">
						<!-- < echo $cityNameErr; ></span> -->
                    </div>
                    <div class="form-group" id="city">
                        <!-- <label for="restaurant">Restaurants</label> -->
                        <!--<input class="form-control" name="search__query" type="text" placeholder="I want.....">-->
                        <label for="search__query" class="form-control">Select Cuisine</label>
                        <select name="search__query" >
                            <option value="indian">Indian</option>
                            <option value="chinese">Chinese</option>
                            <option value="mexican">Mexican</option>
                        </select> 
                        
                        <span class="show-error">
						<!--< echo $restaurantErr; ?></span>-->
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" name="search__button" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" role="button" >Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>
   
	
	<?php
require_once 'includes/footer.php';
?>

</html>