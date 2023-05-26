<?php
include('config.php');
error_reporting(E_ALL);
ini_set('display_errors',TRUE);
$errors = array();

//

//if user signup button
if(isset($_POST['signup'])){
    $fname = mysqli_escape_string($conn, $_POST['fname']);
	$lname = mysqli_escape_string($conn, $_POST['lname']);
	$email = mysqli_escape_string($conn, $_POST['email']);
	$organisation = mysqli_escape_string($conn, $_POST['organisation']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);   
	$balance = 0;

    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered already exists. Try another one.";
    }
    if(count($errors) === 0){        
        $code = rand(999999, 111111);
        $status = "notverified";

        $insert_data = "INSERT INTO  users (fname, lname, email, phone, company, password, code, status, date)
  VALUES ('$fname', '$lname', '$email', '$phone', '$organisation', '$password', '$code', '$status', now())";

        $data_check = mysqli_query($conn, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: info@royaleventbookings.com";
            if(mail($email, $subject, $message, $sender)){
                            
                header('location:user_otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
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
		<title>Royal Events Booking - Sign Up</title>
		
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
				<div class="sign_sidebar_text">

				</div>
			</div>
			<div class="app-form-content">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10 col-md-10">
							<div class="app-top-items">
								<a href="sign_up.php">
									<div class="sign-logo" id="logo">
										<img src="images/royal.jpg" alt="">
										<img class="logo-inverse" src="images/royal.jpg" alt="">
									</div>
								</a>
								<div class="app-top-right-link">
									Already have an account?<a class="sidebar-register-link" href="sign_in.php">Sign In</a>
								</div>
							</div>
						</div>
						<div class="col-xl-5 col-lg-6 col-md-7">
							<div class="registration">
								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<h2 class="registration-title">Sign Up</h2>
									<div class="row mt-3">
										<div>
					                        <?php
							                    if(count($errors) == 1){
							                        ?>
							                        <div class="alert alert-danger text-center">
							                            <?php
							                            foreach($errors as $showerror){
							                                echo $showerror;
							                            }
							                            ?>
							                        </div>
							                        <?php
							                    }elseif(count($errors) > 1){
							                        ?>
							                        <div class="alert alert-danger">
							                            <?php
							                            foreach($errors as $showerror){
							                                ?>
							                                <li><?php echo $showerror; ?></li>
							                                <?php
							                            }
							                            ?>
							                        </div>
					                        <?php
					                    }
					                    ?>
					                    </div>
										<div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">First Name*</label>
												<input class="form-control h_50" type="text" name="fname" required>																								
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Last Name*</label>
												<input class="form-control h_50" type="text" name="lname" required>											
											</div>
										</div>																													
										<div class="col-lg-12 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Organization Name</label>
												<input class="form-control h_50" type="text" name="organisation">																								
											</div>
										</div>
										<div class="copyright-footer" style="text-align:left;">
											<span style="color:red;">*If you are registering on behalf of an organizatiom, state the name above.</span>
										</div>
										<div class="col-lg-12 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Your Email*</label>
												<input class="form-control h_50" type="email" name="email" required>																								
											</div>
										</div>
										<div class="col-lg-12 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Phone Number*</label>
												<input class="form-control h_50" type="number" name="phone" required>																								
											</div>
										</div>
										<div class="col-lg-12 col-md-12">	
											<div class="form-group mt-4">
												<div class="field-password">
													<label class="form-label">Password*</label>
												</div>
												<div class="loc-group position-relative">
													<input class="form-control h_50" id="myInput" name="password" type="password" placeholder="">
													<span onclick="myFunction()" class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12">		
											<button name="signup" class="main-btn btn-hover w-100 mt-4" type="submit">Sign Up</button>
										</div>
									</div>
								</form>
								<div class="agree-text">
									By clicking "Sign up", you agree to Royal Events <a href="#">Terms & Conditions</a> and have read the <a href="#">Privacy Policy</a>.
								</div>								
								<div class="divider">
									<span>or</span>
								</div>
								
								<div class="new-sign-link">
									Do you already have an account?<a class="signup-link" href="sign_in.php">Sign In</a>
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