<?php 
	session_start();
	include('config.php');
	include('myfunctions.php');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Event Bookings - Invoice</title>
		
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
	<!-- Invoice Start-->
	<div class="invoice clearfix" id="container_content">
		<div class="container" id="container">
			<div class="row justify-content-md-center">
				<div class="col-lg-8 col-md-10">
					<div class="invoice-header justify-content-between">
						<div class="invoice-header-logo">
							<img src="images/fav.png" style="width:32px; height:32px;" alt="invoice-logo">
						</div>
						<div class="invoice-header-text">
							<a href="index.php" style="margin-right:20px;" class="download-link">Home</a>							
							<input type="button" id="rep" value="Download" class="btn btn-secondary btn_print">
						</div>
					</div>
					<div class="invoice-body" id="invoice-body">
						<div class="invoice_dts">
							<div class="row">
								<div class="col-md-12">
									<h2 class="invoice_title">Invoice</h2>
								</div>
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
										$category = $fetch['category'];
										$hall = $fetch['hall'];
										$price = $fetch['price'];
										$fullname = $fetch['fullname'];
										$discount = $fetch['discount'];
										$email = $fetch['email'];
										$phone = $fetch['phone'];
										$reference = $fetch['reference'];
										$date = $fetch['date'];

										
									}
								?>
								<div class="col-md-6">
									<div class="vhls140">
										<ul>
											<li><div class="vdt-list">To : <strong><?= $fullname; ?></strong></div></li>
											<li><div class="vdt-list">Email : <strong><?= $email; ?></strong></div></li>
											<li><div class="vdt-list">Phone No : <strong><?= $phone; ?></strong></div></li>											
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<div class="vhls140">
										<ul>
											<li><div class="vdt-list">Invoice ID : <strong><?= $reference; ?></strong></div></li>
											<li><div class="vdt-list">Order Date : <strong><?= $date; ?></strong></div></li>
											<li><div class="vdt-list">Venue : <strong><?= $hall; ?></strong></div></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="invoice_footer">
							<div class="cut-line">								
							</div>
							<div class="main-card">
								<div class="row g-0">
									<div class="col-lg-7">
										<div class="event-order-dt p-4">
											<div class="event-thumbnail-img">
												<img src="images/royal.jpg" alt="">
											</div>
											<div class="event-order-dt-content">
												<h5><strong><?= $name; ?></strong></h5>
												<span><strong><?= $day; ?></strong> <strong><?= $time; ?> Duration <?= $duration; ?></strong></span>
												<div class="buyer-name"><strong><?= $category; ?></strong></div>
												<div class="booking-total-tickets">
													<i class="fa-solid fa-ticket rotate-icon"></i>
													<span class="booking-count-tickets mx-2">Discount: 
														<?php
															if($discount > 0)
															{
																echo $discount."% Off";																
															}
															else
															{
																echo "NO";
															}
														?>														
													</span>
												</div>
												<div class="booking-total-grand">
													Total : <span>&#8358;<strong><?= number_format($price); ?></strong></span>
												</div>
											</div>
										</div>
									</div>									
								</div>
							</div>
							<div class="cut-line">								
							</div>
						</div>
						<div class="main-table bt_40">
							<div class="table-responsive">
								<h2>Addons</h2>
								<table class="table">
									<thead class="thead-dark">
										<tr>											
											<th scope="col">Names</th>
											<th scope="col">Qty</th>
											<th scope="col">Unit Price</th>
											<th scope="col">Total</th>
										</tr>
										<?php
											
											$booking_id = $_SESSION['booking_id'];
											$sql = "SELECT * from booking_addons WHERE booking_id = '$booking_id' ";
											$result = $conn->query($sql);
											while ($rows=mysqli_fetch_assoc($result)){
										?>
									</thead>
									<tbody>
										<tr>																					
											<td><?= $rows['name'];?></td>												
											<td><?= $rows['qty'];?></td>
											<td>&#8358;<?= number_format($rows['price']);?></td>
											<td>&#8358;<?= number_format($rows['tprice']);?></td>
											<?php 
											}
											?>
										</tr>
										<tr>
											<td colspan="1"></td>
											<td colspan="5">
												<div class="user_dt_trans text-end pe-xl-4">
													<div class="totalinv2">Addons Total : NGN
														<?php
															$sql = "SELECT sum(tprice) as sub_total from booking_addons WHERE booking_id='$booking_id' ";
															$result = $conn->query($sql);
															while($record = $result->fetch_array()){
																$sub_total = $record['sub_total'];
																}
														?>
														&#8358;<?php echo number_format($sub_total)?>
													</div>													
												</div>
											</td>
											
										</tr>
										
									</tbody>																		
								</table>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Invoice End-->
	
	
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

	<script type="text/javascript">
	$(document).ready(function($) 
	{ 

		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();
			
			var element = document.getElementById('invoice-body'); 

			//easy
			html2pdf().from(element).save();						
		});
	});
	</script>	
</body>
</html>