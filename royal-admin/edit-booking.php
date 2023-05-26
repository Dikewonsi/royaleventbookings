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
		<title>Royal Event Bookings - Edit Booking</title>
		
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
	<?php 
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $shipments = getByID("bookings", $id);

            if (mysqli_num_rows($shipments) > 0)
            {
                $data = mysqli_fetch_array($shipments);
                                                
    ?>
	<!-- Create Coupon Model Start-->
	<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="couponModalLabel">Edit Booking</h5>
					<button type="button" class="close-model-btn" data-bs-dismiss="modal" aria-label="Close"><i class="uil uil-multiply"></i></button>
				</div>
				<form method="POST" action="code.php">
					<div class="modal-body">
						<div class="model-content main-form">							
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<div class="form-group mt-4">
										<label class="form-label">Booking Reference*</label>
										<input class="form-control h_40" type="text" name="name" disabled value="<?= $data['reference'];?>">
										<input type="" name="id" hidden value="<?= $data['id'];?>">																								
									</div>
								</div>								
								<div class="col-lg-6 col-md-12">
									<div class="form-group mt-4">
										<label class="form-label">Event Status</label>
										<select class="selectpicker" name="status">
											<option value="<?= $data['event_status'];?>"><?= $data['event_status'];?></option>
											<option value="booked">Booked</option>
											<option value="ongoing">Ongoing</option>
											<option value="completed">Completed</option>
										</select>																							
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="co-main-btn min-width btn-hover h_40" data-bs-target="#aboutModal" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" name="edit_booking" class="main-btn min-width btn-hover h_40">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Create Coupon Model End-->
	<div class="wrapper wrapper-body">
		<div class="dashboard-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="d-main-title">
							<h3><i class="fa-solid fa-calendar-days me-3"></i>Edit Event</h3>
						</div>
					</div>
					<div class="col-md-12">
						<div class="main-card mt-5">
							<div class="dashboard-wrap-content p-4">	
														
								<div class="d-md-flex flex-wrap align-items-center">
									<h5 class="mb-4">Booking Preview</h5>
									<div class="rs ms-auto mt_r4">
										<button class="main-btn btn-hover h_40 w-100" data-bs-toggle="modal" data-bs-target="#couponModal"><i class="fa-solid fa-pen me-3"></i>Edit Event Status</button>
									</div>
								</div>
							</div>
						</div>
						<div class="all-promotion-list">
							<div class="main-card mt-4">
								<div class="contact-list coupon-active">
									<div class="top d-flex flex-wrap justify-content-between align-items-center p-4 border_bottom">
										<div class="icon-box">
											<span class="icon-big rotate-icon icon icon-gold">
												<i class="fa-solid fa-ticket"></i>
											</span>
											<h5 class="font-18 mb-1 mt-1 f-weight-medium"><?= $data['event_name'];?></h5>
											<p class="text-gray-50 m-0"><span class="visitor-date-time"><?= $data['event_day'];?></span></p>
										</div>										
									</div>
									<div class="bottom d-flex flex-wrap justify-content-between align-items-center p-4">
										<div class="icon-box ">
											<span class="icon">
												<i class="fa-regular fa-circle-dot"></i>
											</span>
											<p>Status</p>
											<h6 class="coupon-status"><?= $data['event_status'];?></h6>
										</div>
										<div class="icon-box">
											<span class="icon">
												<i class="fa-solid fa-credit-card"></i>
											</span>
											<p>Reference</p>
											<h6 class="coupon-status"><?= $data['reference'];?></h6>											
										</div>
										<div class="icon-box">
											<span class="icon">
												<i class="fa-regular fa-clock"></i>
											</span>
											<p>Last Modified</p>
											<h6 class="coupon-status"><?= $data['modified_at'];?></h6>
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
	<?php
			}
		}

	?>
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