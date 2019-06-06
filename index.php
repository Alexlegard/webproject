<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Need Grub!</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" id="brand-logo" href="#" style="background-image: url(&quot;assets/img/logo.png&quot;);width: 80px;height: 80px;"> </a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right"
                type="button" data-toogle="collapse" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto text-uppercase">
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="contact.php">Contact</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/header-bg.gif');">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in"><span>Hungry?</span></div>
                <div class="intro-heading text-uppercase"><span style="font-family: 'Kaushan Script', cursive;">Find Grub!</span></div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <form action="searchresults.php" method="post" >
                    <div class="form-group" id="city">
                        <!-- <label for="city">City</label> -->
                        <input class="form-control" name="search__city" type="text" placeholder="Enter City">
                        <span class="show-error">
						<!-- < echo $cityNameErr; ></span> -->
                    </div>
                    <div class="form-group" id="city">
                        <!-- <label for="restaurant">Restaurants</label> -->
                        <input class="form-control" name="search__query" type="text" placeholder="Look for Restaurants">
                        <span class="show-error">
						<!-- < echo $restaurantErr; ?></span> -->
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
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