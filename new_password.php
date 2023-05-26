<?php 
 session_start();
$email = $_SESSION['email'];
if($email == false){
  header('Location: signin.php');
}

include ("config.php");
$errors = array();

//if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Passwords do not match!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = $password;
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Your password has been changed. You can now login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password_changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
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
								<a href="index.html">
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
									<h2 class="registration-title">New Password</h2>
									<h6 style="text-align:center;">We're sorry you can't remember your password. Please enter a new one.</h6>
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
									<div class="form-group mt-4">
										<div class="field-password">
											<label class="form-label">Enter Password*</label>											
										</div>
										<div class="loc-group position-relative">
											<input class="form-control h_50" type="password" id="myInput" name="password" placeholder="Enter your password">
											<span onclick="myFunction()" class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
										</div>
									</div>
									<div class="form-group mt-4">
										<div class="field-password">
											<label class="form-label">Confirm Password*</label>
										</div>
										<div class="loc-group position-relative">
											<input class="form-control h_50" type="password" id="myInput1" name="cpassword" placeholder="Confirm your password">
											<span onclick="myFunction1()" class="pass-show-eye"><i class="fas fa-eye-slash"></i></span>
										</div>
									</div>
									<button name="change-password" class="main-btn btn-hover w-100 mt-4" type="submit">Submit <i class="fas fa-sign-in-alt ms-2"></i></button>
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
	<script>
		function myFunction1() {
		  var x = document.getElementById("myInput1");
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