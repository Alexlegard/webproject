<?php
require_once 'database.php';
require_once 'users.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $db = Database::getDb();
    $getuser = $db->prepare("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $getuser->execute();
    $userDetail = $getuser->fetch();

    if($getuser->rowCount() == 1) {
        session_start();
        $_SESSION['role'] = $userDetail['role'];
        $_SESSION['user_id'] = $userDetail['user_id'];
        $_SESSION['name'] = $userDetail['first_name'].' '.$userDetail['last_name'] ;

        header("Location: index.php");

    } else {
        echo '<div class="alert alert-danger">
                <strong>Alert!</strong> 
                    Please Enter correct Email & Password.
              </div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Need Grub</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body id="page-top">
    <header class="masthead" style="background-image:url('assets/img/header-bg.jpg');">
        <div class="container">
            <div class="intro-text" style="padding-top: 50px;padding-bottom: 50px;">
                <div class="intro-heading text-uppercase"><span style="font-family: 'Kaushan Script', cursive;">Find Grub!</span></div>
                <div class="d-flex flex-column justify-content-center" id="login-box" style="background-color: #434141;">
                    <div class="login-box-header" style="background-color: #434141;">
                        <h4 style="color: rgb(255,255,255);margin-bottom: 0px;font-weight: 400;font-size: 27px;"><img src="assets/img/fmd.png" width="50%"></h4>
                    </div>
                    <div class="login-box-content" style="background-color: #434141;">
                        <div class="fb-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" href="#"><i class="fa fa-facebook" style="margin-left:0px;padding-right:20px;padding-left:22px;width:56px;"></i>Login with Facebook</a></div>
                        <div class="gp-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" style="margin-bottom:10px;" href="#"><i class="fa fa-google" style="color:rgb(255,255,255);width:56px;"></i>Login with Google+</a></div>
                        <div class="gp-login box-shadow"
                            style="background-color: #3e6c92;"><a class="d-flex flex-row align-items-center social-login-link" style="margin-bottom:10px;" href="#"><i class="fa fa-instagram" style="color:rgb(255,255,255);width:56px;"></i>Login with Instagram</a></div>
                    </div>
                    <div class="d-flex flex-row align-items-center login-box-seperator-container">
                        <div class="login-box-seperator"></div>
                        <div class="login-box-seperator-text">
                            <p style="margin-bottom:0px;padding-left:10px;padding-right:10px;font-weight:400;color:rgb(201,201,201);">or</p>
                        </div>
                        <div class="login-box-seperator"></div>
                    </div>
                    <div id="main" class="row justify-content-center">
            <div class="col-lg-7">
                <form action="" method="post">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Enter Email Address" required> 
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" type="password" placeholder="Enter password" required> 
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="login" class="btn btn-success">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
                <p style="margin-bottom:0px;">Don't you have an account?<a id="register-link" href="register.php">Register Account!</a></p>
            </div>
            </div>
        </div>
        </div>
    </header>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-12"><span class="copyright">Copyright&nbsp;© Find Grub 2019</span></div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>