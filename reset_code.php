<?php 
 session_start();
$email = $_SESSION['email'];
if($email == false){
  header('Location: signin.php');
}

include ("config.php");
$errors = array();

if(isset($_POST['check-reset-otp'])){

        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            header('location: new_password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered an incorrect OTP!";
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
		<title>Royal Events Booking - Reset OTP Verification</title>
		
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
								<a href="user_otp.php">
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
									<h2 class="registration-title">Password Recovery</h2>
									<h6 style="text-align:center;">A message wtih an OTP Code was sent to your email address, please input the code below to get access to your account.</h6>
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
										<div class="col-lg-12 col-md-12">
											<div class="form-group mt-4">												
												<input class="form-control h_50" type="text" placeholder="Enter OTP" name="otp" required>																								
											</div>
										</div>										
										<div class="col-lg-12 col-md-12">		
											<button name="check-reset-otp" class="main-btn btn-hover w-100 mt-4" type="submit">Verify</button>
										</div>																											
									</div>
								</form>								
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
	
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>

</body>
</html>