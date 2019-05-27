<?php
require_once 'database.php';
require_once 'users.php';

$passErr = $confirmPassErr = $fNameErr = $lNameErr = $emailErr = $email = "";

    if(isset($_POST['register'])){
        $db = Database::getDb();

        if (empty($_POST["password"])) {
            $passErr = "Password is required";
        }

        if (empty($_POST["confirm_password"])) {
            $confirmPassErr = "Confirm Password is required";
        } else if($_POST['password'] != $_POST['confirm_password']) {
            // echo '';
            $passErr = '<div class="alert alert-danger mt-2">
                        <strong>Error!</strong> Password Does Not Match
                    </div>';
        } else {
            $password = md5($_POST['password']);
        }

        if (empty($_POST["fName"])) {
            $fNameErr = "First Name is required";
        } else {
            $fName = $_POST['fName'];
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = $_POST['email'];
            $getuser = $db->prepare("SELECT * FROM users WHERE email='$email'");
            $getuser->execute();
        }

        if (empty($_POST["lName"])) {
            $lNameErr = "Last Name is required";
        } else {
            $lName = $_POST['lName'];
        }


        if(isValid($passErr, $emailErr, $confirmPassErr, $fNameErr, $lNameErr)) {
            if($email != '' && $getuser->rowCount() == 0) {
                $role = 'User';

                $sign_up_date = new DateTime();
                $sign_up_date = $sign_up_date->format('Y-m-d');

                $db = Database::getDb();
                $pdo = new Users();
                $userData = $pdo->register($fName, $lName, $email, $password, $sign_up_date, $db);
                if($userData) {
                    echo '<div class="alert alert-success">
                        <strong>Success!</strong>Account Registered SuccessFully
                      </div>';
                } else {
                    echo "Problem in adding Account";
                }
            } else {
                echo '<div class="alert alert-danger">
                        <strong>Error!</strong> Email Already exists
                      </div>';

            }    
       }

    }       

    function isValid($passErr, $emailErr, $confirmPassErr, $fNameErr, $lNameErr) {
        if($passErr == '' && $emailErr == '' && $confirmPassErr == '' && $fNameErr == '' && $lNameErr == '') {
            return true;
        }
        return false;
    }   
    
?>
<!DOCTYPE html>
<html lang="en">
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
    <header class="masthead" style="background-image:url('assets/img/header-bg.jpg');">
        <div class="container">
            <div class="intro-text" style="padding-top: 50px;padding-bottom: 50px;">
                <div class="intro-heading text-uppercase"><span style="font-family: 'Kaushan Script', cursive;">Find grub!</span></div>
                <div class="d-flex flex-column justify-content-center" id="login-box" style="background-color: #434141;">
                    <div class="login-box-header" style="background-color: #434141;">
                        <h4 style="color: rgb(255,255,255);margin-bottom: 0px;font-weight: 400;font-size: 27px;"><img src="assets/img/fmd.png" width="50%"></h4>
                    </div>

                    <div class="d-flex flex-row align-items-center login-box-seperator-container">
                        <div class="login-box-seperator"></div>
                        <div class="login-box-seperator-text">
                        </div>
                        <div class="login-box-seperator"></div>
                        <div id="mainc" class="container">
        <div class="row justify-content-center">
            <h3>Register Here</h3>
        </div>  
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fName">First Name</label>
                        <input class="form-control" name="fName" type="text" placeholder="Enter First Name">
                        <span class="show-error"><?php echo $fNameErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="lName">Last Name</label>
                        <input class="form-control" name="lName" type="text" placeholder="Enter Last Name">
                        <span class="show-error"><?php echo $lNameErr; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Enter Email Address"> 
                        <span class="show-error"><?php echo $emailErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" type="password" placeholder="Enter password"> 
                        <span class="show-error"><?php echo $passErr; ?></span>

                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" name="confirm_password" type="password" placeholder="Confirm Password"> 
                        <span class="show-error"><?php echo $confirmPassErr; ?></span>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="register" class="btn btn-success">Register!</button>
                    
                    </div>        
                    <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
                        <p style="margin-bottom:0px;">Have an account?<a id="register-link" href="login.php">Sign In!</a></p>
                    </div>
                </form>
            </div>
        </div>
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