<?php
	session_start();
	include('config.php');
	include('myfunctions.php');

	if(!isset($_SESSION['admin_id'])){
		header("location:sign_in.php ");
	}
	else
	{
		$userid = $_SESSION['admin_id'];
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
		<title>Royal Event Bookings - Bookings</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/style.css" rel="stylesheet">
		<link href="css/vertical-responsive-menu.min.css" rel="stylesheet">
		<link href="css/analytics.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">	
		<link href="vendor/chartist/dist/chartist.min.css" rel="stylesheet">
		<link href="vendor/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.css" rel="stylesheet">

		<!-- AlertifyJS -->
	    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		
	</head>

<body class="d-flex flex-column h-100">

	<!-- Header Start-->

	<!-- Header End --> 
	<?php include('header.php'); ?>
	<!-- Left Sidebar Start -->

	<!-- Left Sidebar End -->
	<!-- Body Start -->
	<div class="wrapper wrapper-body">
		<div class="dashboard-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="d-main-title">
							<h3><i class="fa-regular fa-address-card me-3"></i>Event Details</h3>
						</div>
					</div>

					<div class="all-promotion-list">
							<?php 
			                    if (isset($_GET['id']))
			                    {
			                        $id = $_GET['id'];
			                        $bookings = getByID("bookings", $id);

			                        if (mysqli_num_rows($bookings) > 0)
			                        {
			                            $data = mysqli_fetch_array($bookings);
			                                                            
			                ?>
							<div class="main-card mt-4">							
								<div class="contact-list coupon-active">
									<div class="top d-flex flex-wrap justify-content-between align-items-center p-4 border_bottom">
									
										<div class="icon-box coupon-icon-box-8606">
											<span class="icon-big icon icon-purple">
												<img src="images/fav.png" style="width:50px; height:50px;" alt="">
											</span>
											<h5 class="font-18 mb-1 mt-1 f-weight-medium"><?= $data['event_name'];?></h5>
											<p class="text-gray-50 m-0"><?= $data['category'];?></p>
										</div>
										<div class="d-flex align-items-center">
											<div class="dropdown dropdown-default dropdown-text dropdown-icon-item">
												<button class="option-btn-1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fa-solid fa-ellipsis-vertical"></i>
												</button>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="edit-booking.php?id=<?= $data['id'];?> " class="dropdown-item"><i class="fa-solid fa-pen me-3"></i>Edit Booking</a>
												</div>
											</div>
										</div>
									</div>

									<div class="bottom d-flex flex-wrap justify-content-between align-items-center p-4">
										<div class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-user"></i>
											</span>
											<p>By</p>
											<h6 class="coupon-status"><?= $data['fullname'];?></h6>
										</div>
										<div class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-calendar-days"></i>
											</span>
											<p>Event Day</p>
											<h6 class="coupon-status"><?= $data['event_day'];?></h6>
										</div>
										<div class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-clock"></i>
											</span>
											<p>Event Time</p>
											<h6 class="coupon-status"><?= $data['event_time'];?></h6>
										</div>
										<div class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-clock"></i>
											</span>
											<p>Duration of Event</p>
											<h6 class="coupon-status"><?= $data['duration'];?></h6>
										</div>
										<div style="margin-top:40px;" class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-home"></i>
											</span>
											<p>Event Hall</p>
											<h6 class="coupon-status"><?= $data['hall'];?></h6>
										</div>
										<div style="margin-top:40px;" class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-credit-card"></i>
											</span>
											<p>Payment Reference</p>
											<h6 class="coupon-status"><?= $data['reference'];?></h6>
										</div>									
										<div style="margin-top:40px;" class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-calendar-days"></i>
											</span>
											<p>Date Of Payment</p>
											<h6 class="coupon-status"><?= $data['date'];?></h6>
										</div>
										<div style="margin-top:40px;" class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-info"></i>
											</span>
											<p>Event Status</p>
											<?php
												$event_status = $data['event_status'];
												if ($event_status == 'booked') {
													echo '<h6 class="coupon-status"><span class="status-circle yellow-circle"></span>Booked</h6>';
												}
												else if ($event_status == 'ongoing') {
													echo '<h6 class="coupon-status"><span class="status-circle blue-circle"></span>Ongoing</h6>';
												}
												else if ($event_status == 'completed') {
													echo '<h6 class="coupon-status"><span class="status-circle green-circle"></span>Completed</h6>';
												}
											?>	
										</div>
									</div>							
								</div>						
							</div>
							<?php
									}
								}
							?>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->

	<script src="js/vertical-responsive-menu.min.js"></script>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="vendor/chartist/dist/chartist.min.js"></script>
	<script src="vendor/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
	<script src="js/analytics.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>	

</body>
</html>