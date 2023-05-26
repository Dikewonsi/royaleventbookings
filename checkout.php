<?php 
	session_start();
	$errors = array();
	include('config.php');
    if(!isset($_SESSION['userid']))
	{
		header("location:sign_in.php");
		exit();
	}

    $userid = $_SESSION['userid'];

    //Changing to number format
    $price = $_SESSION['price'];
	$amount = number_format($price);	

	$booking_id = $_SESSION['booking_id'];

	//Calculating total amount to be paid
    $total = $price + 30000;
    $_SESSION['total'] = $total;
	$new_total = number_format($total);

	if(isset($_POST['applyCoupon']))
	{
		$coupon_code = $_POST['coupon'];
		$price = $_POST['price'];


		$coupon_query = "SELECT * FROM coupon WHERE coupon_code = '$coupon_code' AND status = 'Valid'";
		$coupon_query_run = mysqli_query($conn, $coupon_query);

		
		$count = mysqli_num_rows($coupon_query_run);
		$fetch = mysqli_fetch_array($coupon_query_run);
		$array = array();
		if($count > 0){
			$discount = $fetch['discount'] / 100;
			$total = $discount * $price;
			$_SESSION['discount'] = $fetch['discount'];
			$_SESSION['new_price'] = $price - $total;

			$_SESSION['old_price'] = $price;

			$_SESSION['coupon_code'] = $coupon_code;
						
			header("Location:discount-checkout.php");	
			
			
		}else
		{
			header("Location:checkout.php");	
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
		<title>Royal Event Booking - Checkout</title>
		
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
									<li class="breadcrumb-item"><a href="book_event.php">Event Details</a></li>
									<li class="breadcrumb-item"><a href="book_event1.php"></a>Book Hall</li>
									<li class="breadcrumb-item active" aria-current="page">Checkout</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="event-dt-block p-80">
			<div class="container">								
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="main-title checkout-title">
							<h3>Order Confirmation</h3>
						</div>
					</div>
					<?php
						$sql = "SELECT sum(tprice) as sub_total from booking_addons WHERE booking_id='$booking_id' ";
						$result = $conn->query($sql);
						while($record = $result->fetch_array()){
							$sub_total = $record['sub_total'];
							}
					?>
					<div class="col-xl-4 col-lg-12 col-md-12">
						<div class="main-card order-summary">
							<div class="bp-title">
								<h4>Event Information</h4>
							</div>
							<div class="order-summary-content p_30">
								<div class="event-order-dt">
									<div class="event-thumbnail-img">
										<img src="images/event-imgs/royal.jpg" alt="">
									</div>
									<div class="event-order-dt-content">
										<h5><?= $_SESSION['event_name']; ?></h5>
										<?php 
											$date = $_SESSION['picked_date'];

											$event_day = date("D, d M Y", strtotime($date));

											$_SESSION['event_day'] = $event_day;
										?>
										<span>Date: <?= $event_day?></span>
										<div id="category" class="category-type">Event Category: <?= $_SESSION['event_category']; ?></div>
									</div>
								</div>
								<div class="order-total-block">
									<div class="order-total-dt">
										<div class="order-text">Hall Price</div>
										<div class="order-number">&#8358;<?= $amount; ?>										
										</div>
									</div>
									<div class="order-total-dt">
										<div class="order-text">Addons</div>
										<div class="order-number">&#8358;<?= number_format($sub_total) ?></div>
									</div>
									<div class="order-total-dt">
										<div class="order-text">Caution Fee (Refundable)</div>
										<?php
											$get_caution_query = "SELECT * FROM caution_fee WHERE id = 1";
											$get_caution_query_run = mysqli_query($conn, $get_caution_query);

											if($get_caution_query_run)
											{
												$rows = mysqli_fetch_assoc($get_caution_query_run);
												$caution_fee = $rows['price'];											
											}
										?>
										<div class="order-number">&#8358;<?= number_format($caution_fee); ?></div>
									</div>										
									<div class="divider-line"></div>
									<div class="order-total-dt">
										<div class="order-text">Total</div>
										<div class="order-number ttl-clr">&#8358;
											<?php
												$temp_total = $price+$sub_total+$caution_fee;;

												$_SESSION['temp_total'] = $temp_total;

												echo number_format($temp_total);
											?>
										</div>
									</div>
								</div>
								<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">									
									<div class="coupon-code-block">
										<div class="form-group mt-4">
											<label class="form-label">Coupon Code*</label>
											<div class="position-relative">
												<input class="form-control h_50" type="text" name="coupon" placeholder="Code" required>
												<input type="hidden" name="price" value="<?= $temp_total; ?>">
												<button class="apply-btn btn-hover" name="applyCoupon" type="submit">Apply</button>
											</div>
										</div>
									</div>
								</form>
								<div class="confirmation-btn">
									<?php
										$booking_id = $_SESSION['booking_id'];
									?>
									<a href="save_booking.php?id=<?= $booking_id; ?>" type="submit" class="main-btn btn-hover h_50 w-100 mt-5">Confirm & Save Now</a>									
								</div>
							</div>
						</div>							
					</div>
					<div class="col-xl-8 col-lg-12 col-md-12">
						<div class="checkout-block">
							<div class="main-card">
								<div class="bp-title">
									<h4>Total Amount For Selected Addons :
										<?php
											$sql = "SELECT sum(tprice) as sub_total from booking_addons WHERE booking_id='$booking_id' ";
											$result = $conn->query($sql);
											while($record = $result->fetch_array()){
												$sub_total = $record['sub_total'];
												}
										?>
										&#8358;<?php echo number_format($sub_total)?></h4>
								</div>
								<div class="bp-content bp-form">
									<div class="row">
										<div class="col-lg-3 col-md-12">
											<div class="form-group mt-4">
												<?php
													$booking_id = $_SESSION['booking_id'];

													$total_amount = 0;			

													$sql = "SELECT * from booking_addons WHERE booking_id = '$booking_id' ";
													$result = $conn->query($sql);
													while ($rows=mysqli_fetch_assoc($result))
													{
													
												?>
												<p><?= $rows['name'];?> : <?= $rows['qty'];?>pcs</p>
												<?php
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