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
		<title>Royal Event Bookings - Users</title>
		
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
							<h3><i class="fa-solid fa-user-group me-3"></i>All Users</h3>
						</div>
					</div>
					<div class="col-md-12">
						<div class="conversion-setup">							
							<div class="tab-content">
								<div class="tab-pane fade active show" id="overview-tab" role="tabpanel">
									<div class="table-card mt-4">
										<div class="main-table">
											<div class="table-responsive">
												<table class="table">
													<thead class="thead-dark">
														<tr>
															<th scope="col">sn</th>
															<th scope="col">First Name</th>
															<th scope="col">Last Name</th>
															<th scope="col">Email</th>
															<th scope="col">Phone</th>
															<th scope="col">Company</th>
															<th scope="col">Date</th>															
														</tr>
														<?php
				                                            $sql = "SELECT * from users";
				                                            $result = $conn->query($sql);
				                                            while ($rows=mysqli_fetch_assoc($result)){
				                                            
				                                        ?>
													</thead>
													<tbody>
														<tr>
															<td><?= $rows['userid'];?></td>										
															<td><?= $rows['fname'];?></td>	
															<td><?= $rows['lname'];?></td>
															<td><?= $rows['email'];?></td>
															<td><?= $rows['phone'];?></td>
															<td><?= $rows['company'];?></td>
															<td><?= $rows['date'];?></td>															
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