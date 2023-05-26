<?php 
    session_start();
    include("config.php");
	include('royal-admin/myfunctions.php');
    error_reporting(E_ALL);
	ini_set('display_errors',TRUE);
	$errors = array();


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
		<title>Royal Event Bookings - Book Event</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/style.css" rel="stylesheet">
		<link href="css/datepicker.min.css" rel="stylesheet">
		<link href="css/jquery-steps.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">		
		<link href="vendor/ckeditor5/sample/css/sample.css" rel="stylesheet">		
				
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
									<li class="breadcrumb-item active" aria-current="page">Book Hall</li>
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
					<div class="col-lg-12 col-md-12">
						<div class="main-title text-center">
							<h3>Choose A Hall</h3>							
						</div>
					</div>
					<!-- <div class="col-lg-12 col-md-12">						
						<div class="form-group border_bottom pb_30">
							<label class="form-label fs-16">Event Details</label>
							<p >Date: <strong><?= $_SESSION['picked_date']; ?></strong></p>					
							<p class="">Time: <strong><?= $_SESSION['event_time']; ?></strong></p>		
							<p class="">Duration: <strong><?= $_SESSION['duration']; ?></strong></p>								
						</div>
					</div> -->
					<div class="col-xl-8 col-lg-9 col-md-12">
						<div class="wizard-steps-block">
							<form method="POST" action="code.php">
								<div>									
									<div class="step-content">
										<div class="step-tab-panel step-tab-gallery" id="tab_step2">
											<div class="tab-from-content">
												<div class="main-card">
													<div class="bp-title">
														<h4><i class="fa-solid fa-home step_icon me-3"></i>Halls</h4>
													</div>
													<div class="bp-form main-form">
														<div class="p-4 form-group border_bottom pb_30">
															<div class="">															
																<div class="ticket-type-item-list mt-4">
																	<?php
																		$sql = "SELECT * from halls";
																		$result = $conn->query($sql);
																		while ($rows=mysqli_fetch_assoc($result)){
																		
																	?>
																	<div class="price-ticket-card mt-4">
																		<div class="price-ticket-card-head d-md-flex flex-wrap align-items-start justify-content-between position-relative p-4">
																			<div class="d-flex align-items-center top-name">
																				<div class="icon-box">
																					<span class="icon-big icon icon-purple">
																						<i class="fa-solid fa-home"></i>
																					</span>
																					<h5 class="fs-16 mb-1 mt-1"><?= $rows['name']?> - &#8358;<?= number_format($rows['price']);?></h5>																					
																				</div>
																			</div>
																		</div>
																		<div class="price-ticket-card-body border_top p-4">
																			<div class="full-width d-flex flex-wrap justify-content-between align-items-center">
																				<div class="icon-box">
																					<div class="icon me-3">
																						<i class="fa-solid fa-chair"></i>
																					</div>
																					<span class="text-145">Total Capacity</span>
																					<h6 class="coupon-status">
																						<?= $rows['capacity']?>+
																					</h6>
																				</div>																		
																			</div>
																		</div>
																	</div>
																	<?php
																		}
																	?>														
																</div>
																<div class="row">
																	<div class="col-12">
																		<div class="form-group mt-4">
																			<label class="form-label mb-2 fs-14">Select One to Continue</label>
																			<div class="bp-content bp-form">
																				<div class="row">
																					<div class="col-lg-6 col-md-12">
																						<div class="form-group main-form mt-4">
																							<label class="form-label">Hall*</label>
																							<select class="selectpicker" name="hall_name" required data-size="5" title="Nothing selected" data-live-search="true">
																								<?php
																									$hall = getAll("halls");

																									if (mysqli_num_rows($hall) > 0)
																									{
																										foreach ($hall as $item)
																										{
																											?>
																												<option value="<?php echo $item['name'];?>"><?php echo $item['name'];?></option>
																											<?php
																										}
																									}
																								?>																																			
																							</select>
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
											</div>
										</div>										
									</div>
									<div class="step-footer step-tab-pager mt-4">
										<a href="book_event.php" class="btn btn-default btn-hover steps_btn">Previous</a>
										<button type="submit" name="submitHallBtn" class="btn btn-default btn-hover steps_btn">Next</button>
									</div>
								</div>
							</form>
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
	<script src="vendor/ckeditor5/ckeditor.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/night-mode.js"></script>
	<script src="js/jquery-steps.min.js"></script>
	<script src="js/datepicker.min.js"></script>
	<script src="js/i18n/datepicker.en.js"></script>	
	<script>
		ClassicEditor
		.create( document.querySelector( '#pd_editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	</script>
</body>
</html>