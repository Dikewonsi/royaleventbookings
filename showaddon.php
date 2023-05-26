<?php
	session_start();
	include('config.php');

	$booking_id = $_SESSION['booking_id'];
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Event Bookings - Selected Addons</title>
		
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
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Selected Addons</li>
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
					<div class="col-xl-4 col-lg-6">						
						<div class="main-card p_30 mt-4">
							<div class="total-refer-count text-center">
								<h2>
									<?php
										$sql = "SELECT sum(tprice) as sub_total from booking_addons WHERE booking_id='$booking_id' ";
										$result = $conn->query($sql);
										while($record = $result->fetch_array()){
											$sub_total = $record['sub_total'];
											}
									?>
									&#8358;<?php echo number_format($sub_total)?>
								</h2>
								<span>Total Amount Of Selected Addons</span>
							</div>
						</div>
						<div class="main-card mt-4">
							<div class="bp-title">
								<h4>Continue</h4>
							</div>
							<div class="bp-content faq-widget-content">
								<br>
								<a href="checkout.php" class="main-btn btn-hover h_40 w-100">Proceed to Checkout<i class="fa-solid fa-arrow-right ms-2"></i></a>								
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-6">	
						<div class="main-card mt-4">					
							<div class="main-table">
								<div class="table-responsive">
									<table class="table">
										<thead class="thead-dark">
											<tr>
												<th scope="col">name</th>
												<th scope="col">price</th>
												<th scope="col">qty</th>	
												<th scope="col">Total</th>	
												<th scope="col">Action</th>
											</tr>
												<?php
													$booking_id = $_SESSION['booking_id'];

													$total_amount = 0;			

													$sql = "SELECT * from booking_addons WHERE booking_id = '$booking_id' ";
													$result = $conn->query($sql);
													while ($rows=mysqli_fetch_assoc($result)){
													
												?>
										</thead>
										<tbody>
											<tr>										
												<td><?= $rows['name'];?></td>		
												<td><?= $rows['price'];?></td>																					
												<td>
													<form action="functions/update-cart.php" method="get" autocomplete="off">																											
														<input type="number" min="1" max="200" name="qty" class="form-control" value="<?= $rows['qty'];?>">													
														<input type="hidden" name="id" value="<?= $rows['id'];?>">
														<input type="hidden" name="price" value="<?= $rows['price'];?>">
														<br>
														<div align="center">
															<button type="submit" name="update_qty" class="main-btn btn-hover h_40 ">Update</button>
														</div>
													</form>	
												</td>												
												<td>
													<?= $rows['tprice'];?>
												</td>																																											
												<td>
													<span class="action-btn"><a href="deleting-addon.php?id=<?= $rows['id'];?>"><i class="fa-solid fa-trash-can"></i></a></span>
												</td>	
											</tr>	
											<?php
												}
											?>														
										</tbody>									
									</table>
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

	<!-- AlertJS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        alertify.set('notifier','position', 'top-right');
        <?php
            if (isset($_SESSION['message']))
            {
                ?>        
                alertify.success('<?php echo $_SESSION['message']; ?>');
            <?php
                unset($_SESSION['message']);
                exit();
            }
        ?>
    </script>
</body>
</html>