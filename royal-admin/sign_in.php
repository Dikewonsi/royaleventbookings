<?php
	include('config.php');
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors',TRUE); 
    $errors = array();

    if(isset($_POST['login_admin'])){        
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);

        $sql = "SELECT * from admin where username = '$username' and password= '$password' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {   
            while($row = mysqli_fetch_assoc($result)) {   
                $_SESSION['admin_id']=$row['id'];  
                $_SESSION['admin_username']=$row['username'];
                $_SESSION['admin_pass']=$row['password'];  
                header ("location:index.php");   
            }                             
        }else{
            $errors['email'] = "Incorrect username or password!";
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
		<title>Royal Event Bookings - Home</title>
		
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
					<img src="images/royal.jpg" style="width:1000px; height:100;" alt="">
				</div>
				<div class="sign_sidebar_text">
					<h1 style="color:black;">The Easiest way to manage your bookings and inventory anytime.</h1>
				</div>
			</div>
			<div class="app-form-content">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10 col-md-10">
							<div class="app-top-items">
								<a href="login.php">
									<div class="sign-logo" id="logo">
										<img src="images/royal.jpg" alt="">
										<img class="logo-inverse" src="images/royal.jpg" alt="">
									</div>
								</a>								
							</div>
						</div>					
						<div class="col-xl-5 col-lg-6 col-md-7">
							<div class="registration">
								<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
									<h2 class="registration-title">Sign in to Admin</h2>
									<br>
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
									<div class="form-group mt-5">
										<label class="form-label">Your Username*</label>
										<input class="form-control h_50" type="text" name="username" placeholder="Enter your username">						
									</div>
									<div class="form-group mt-4">
										<div class="field-password">
											<label class="form-label">Password*</label>											
										</div>
										<div class="loc-group position-relative">
											<input class="form-control h_50" type="password" name="password" placeholder="Enter your password">
										</div>
									</div>
									<button class="main-btn btn-hover w-100 mt-4" type="submit" name="login_admin">Sign In <i class="fas fa-sign-in-alt ms-2"></i></button>
								</form>								
							</div>							
						</div>
					</div>
				</div>
				<div class="copyright-footer">
					© 2022, D2D. All rights reserved. Powered by Vortex
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