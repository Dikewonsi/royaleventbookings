<?php 
	session_start();
    include("config.php");

    if(!isset($_SESSION['userid'])){
            header("location:sign_in.php");
            exit();
        }

    $userid = $_SESSION['userid'];


?>
<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Event Bookings - User Profile</title>
		
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

<body class="d-flex flex-column h-100">	
	<!-- Header Start-->
	<?php include('header.php');?>
	<!-- Header End-->
	<!-- Body Start-->
	<div class="wrapper">
		<div class="profile-banner">
			<div class="hero-cover-block">
				<div class="hero-cover">
					<div class="hero-cover-img"></div>	
				</div>
			</div>
			<div class="user-dt-block">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-lg-5 col-md-12">
							<div class="main-card user-left-dt">
								<div class="user-avatar-img">
									<img src="images/profile-imgs/user.png" alt="">
								</div>
								<div class="user-dts">
									<h4 class="user-name"><?=  $_SESSION['fname']; ?> <?=  $_SESSION['lname']; ?><span class="verify-badge"><i class="fa-solid fa-circle-check"></i></span></h4>
									<span class="user-email"><?=  $_SESSION['email']; ?></span>
								</div>
								<div class="ff-block">
									<a href="#" class="" role="button"><span>
										<?php
											$sql = "SELECT count('id') FROM bookings WHERE userid = '$userid'";
											$result = $conn->query($sql);
											$row=mysqli_fetch_array($result);
											echo "$row[0]";
										?>
									</span>Events Booked</a>
									<a href="#" class="" role="button"><span>
										<?php
											echo $_SESSION['date'];
										?>
									</span>Date Registered</a>
									
								</div>
								<div class="user-description">
									<p><?=  $_SESSION['company']; ?></p>
								</div>
								<div class="user-btns">
									<a href="check_date.php" class="main-btn btn-hover min-width h_40 me-2">Book Event</a>
									<button href="livechat.php" class="co-main-btn min-width h_40" onclick="window.location.href='livechat.php'">Contact Us</button>
								</div>								
							</div>
						</div>
						<div class="col-xl-8 col-lg-7 col-md-12">
							<div class="right-profile mt-2">
								<div class="user-events">
									<div class="row">
										<?php
                                            $sql = "SELECT * from bookings WHERE userid = '$userid'";
                                            $result = $conn->query($sql);
                                            if (mysqli_num_rows($result) > 0)
                                            {
                                            	while ($rows=mysqli_fetch_assoc($result)){
                                            
                                        ?>
										<div class="col-md-12">
											<div class="main-card mt-4">
												<div class="card-top p-4 border-bottom-0">
													<div class="card-event-img">
														<img src="images/event-imgs/royal.jpg" alt="">
													</div>
													<div class="card-event-dt">
														<h5><?= $rows['event_name']; ?></h5>
														<div class="evnt-time">Date:<?= $rows['event_date']; ?></div>
														<div class="evnt-time">ID: REB<?= $rows['reference']; ?></div>
														<div class="event-btn-group">
															<a class="esv-btn me-2" href="event_details.php?id= <?= $rows['id'];?>"><i class="fa-solid fa-arrow-up-from-bracket me-2"></i>View</a>
														</div>
													</div>
												</div>																
											</div>
										<?php
											}
										}
										else
										{
											echo "No records Found.";
										}
										?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- Body End-->
	
	
	
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>
</body>
</html>