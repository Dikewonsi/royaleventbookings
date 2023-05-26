<?php
    session_start();
    include('config.php');

    // echo $_SESSION['booking_id'];
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Events Booking - Booking Recorded</title>
		
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
		<div class="breadcrumb-block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-10">
						<div class="barren-breadcrumb">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
									<p class="ps-lg-4 pe-lg-4">We are pleased to inform you that your reservation request has been received and confirmed. To continue, select the left button to pick addons page or
                                        the right to save and complete your booking.</p>									
								</div>                            
								<div class="booking-confirmed-bottom">
									<div class="booking-confirmed-bottom-bg p_30">
										<div class="event-order-dt">
											<div class="event-thumbnail-img">
												<img src="images/royal.jpg" alt="">
											</div>
                                            <?php
                                                $booking_id = $_SESSION['booking_id'];
                                                
                                                $booking_query = "SELECT * FROM bookings WHERE id = '$booking_id' ";
                                                $booking_query_run = mysqli_query($conn, $booking_query);

                                                foreach ($booking_query_run as $item)
                                                {                                                    
                                                    ?>
                                                        <div class="event-order-dt-content">
                                                            <h5><?= $item['event_name'];?></h5>
                                                            <span><?= $item['event_day'];?> <?= $item['event_time'];?>. Duration <?= $item['duration'];?></span>
                                                            <div class="buyer-name"><?= $item['fullname'];?></div>
                                                            <div class="booking-total-tickets">
                                                                <i class="fa-solid fa-house"></i>
                                                                <span class="booking-count-tickets mx-2"><?= $item['hall'];?></span>
                                                            </div>
                                                            <div class="booking-total-grand">
                                                                Total : <span>&#8358;<?= number_format($item['price'])?></span>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }                                                    
                                            ?>											
										</div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="add-ons.php" class="main-btn btn-hover h_50 w-100 mt-5"><i class="fa-solid fa-plus me-3"></i>Pick Add Ons</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="checkout.php" class="main-btn btn-hover h_50 w-100 mt-5"><i class="fa-solid fa-bookmark me-3"></i>Save</a>
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