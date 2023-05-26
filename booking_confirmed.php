<?php
	session_start();
	include('config.php');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Event Bookings - Booking Success</title>
		
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
		<?php include('header.php'); ?>
	<!-- Header End-->
	<!-- Body Start-->
	<div class="wrapper">
		<div class="breadcrumb-block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-10">
						<div class="barren-breadcrumb">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Booking Confirmed</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="event-dt-block p-80">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-5 col-lg-7 col-md-10">
						<div class="booking-confirmed-content">
							<div class="main-card">
								<div class="booking-confirmed-top text-center p_30">
									<div class="booking-confirmed-img mt-4">
										<img src="images/confirmed.png" alt="">
									</div>
									<h4>Booking Confirmed</h4>
									<p class="ps-lg-4 pe-lg-4">We are pleased to inform you that your reservation request has been received and payment has been confirmed.</p>									
								</div>
								<div class="booking-confirmed-bottom">
									<div class="booking-confirmed-bottom-bg p_30">
										<div class="event-order-dt">
											<div class="event-thumbnail-img">
												<img src="images/event-imgs/royal.jpg" alt="">
											</div>
											<div class="event-order-dt-content">
												<?php
													$booking_id = $_SESSION['booking_id'];
													$query = "SELECT * FROM bookings WHERE id = '$booking_id' ";
													$query_run = mysqli_query($conn, $query);

													if(mysqli_num_rows($query_run) > 0)
													{
														$fetch = mysqli_fetch_assoc($query_run);
														$day = $fetch['event_day'];
														$time = $fetch['event_time'];
														$duration = $fetch['duration'];
														$name = $fetch['event_name'];
														$hall = $fetch['hall'];
														$price = $fetch['price'];
														
													}
												?>
												<h5><?= $name;?></h5>
												<span><?= $day; ?> <?= $time;?>. Duration <?= $duration;?></span>
												<div class="buyer-name"><?= $_SESSION['fullname'];?></div>
												<div class="booking-total-tickets">
													<i class="fa-solid fa-home"></i>
													<span class="booking-count-tickets mx-2"><?= $hall; ?></span>
												</div>
												<div class="booking-total-grand">
													Total : <span>&#8358;<?= number_format($price);?></span>
												</div>
											</div>
										</div>
										<a href="invoice.php" class="main-btn btn-hover h_50 w-100 mt-5"><i class="fa-solid fa-ticket rotate-icon me-3"></i>View Invoice</a>
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
	<!-- Footer Start-->
	<?php include('footer.php'); ?>
	<!-- Footer End-->
	
	
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>
</body>
</html>