<?php

	session_start();

	$errors = array();

include ("config.php");


    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if($fetch_pass == $password){
                $_SESSION['email'] = $email;
                $verified = $fetch['status'];
                if($verified == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: index.php');
                }else{                   
                    header('location: user_otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "You are not a registered user! Click on the bottom link to signup.";
        }

    }

     if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {

// Anytime you see a $row['whatever'] it refers to a field in your table on your database.

    $_SESSION['userid']=$row['userid'];
    $_SESSION['fname']=$row['fname'];
    $_SESSION['lname']=$row['lname'];
    $_SESSION['phone']=$row['phone'];
    $_SESSION['email']=$row['email'];
    $_SESSION['company']=$row['company'];
    $_SESSION['password']=$row['password'];
    $_SESSION['date']=$row['date'];
   
   }
        
}
    }

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Events Booking - Sign In</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/style.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">		
		
	</head>

<body>				
	<div class="form-wrapper">
		<div class="app-form">
			<div class="app-form-sidebar">
				<div class="sidebar-sign-logo">
					<img src="images/royal.jpg" alt="">
				</div>
			</div>
			<div class="app-form-content">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10 col-md-10">
							<div class="app-top-items">
								<a href="index.php">
									<div class="sign-logo" id="logo">
										<img src="images/royal.jpg" alt="">
										<img class="logo-inverse" src="images/royal.jpg" alt="">
									</div>
								</a>								
							</div>
						</div>
						<div class="col-xl-5 col-lg-6 col-md-7">
							<div class="registration">
								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<h2 class="registration-title">Sign in</h2>
									<div>
				                        <?php
						                    if(count($errors) > 0){
						                        ?>
						                        <div class="alert alert-danger text-center">
						                            <?php
						                            foreach($errors as $showerror){
						                                echo $showerror;
						                            }
						                            ?>
						                        </div>
						                        <?php
						                    }
						                ?>
						            </div>						                   
									<div class="form-group mt-5">
										<label class="form-label">Your Email*</label>
										<input class="form-control h_50" type="email" name="email" placeholder="Enter your email" value="">																								
									</div>
									<div class="form-group mt-4">
										<div class="field-password">
											<label class="form-label">Password*</label>
											<a class="forgot-pass-link" href="forgot_password.php">Forgot Password?</a>
										</div>
										<div class="loc-group position-relative">
											<input class="form-control h_50" type="password" id="myInput" name="password" placeholder="Enter your password">
											<span onclick="myFunction()" class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
										</div>
									</div>
									<button name="login" class="main-btn btn-hover w-100 mt-4" type="submit">Sign In <i class="fas fa-sign-in-alt ms-2"></i></button>
								</form>
								<div class="divider">
									<span>or</span>
								</div>	
								<div class="social-btns-list">
									New to Royal Events?<a class="signup-link" href="sign_up.php">Sign up</a>
								</div>															
							</div>							
						</div>
					</div>
				</div>
				<div class="copyright-footer">
					© <?php echo date("Y");?>, Royal Events. All rights reserved. Powered by <span style="color:#5ced73;">VORTEX</span>
				</div>
			</div>			
		</div>
	</div>

	<script>
		function myFunction() {
		  var x = document.getElementById("myInput");
		  if (x.type === "password") {
		    x.type = "text";
		  } else {
		    x.type = "password";
		  }
		}

	</script>
	
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>

</body>
</html>