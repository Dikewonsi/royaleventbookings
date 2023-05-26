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
		<title>Royal Event Bookings - Home</title>
		
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
							<h3><i class="fa-solid fa-gauge me-3"></i>Dashboard</h3>
						</div>
					</div>
					<div class="col-md-12">
						<div class="main-card add-organisation-card p-4 mt-5">
							<div class="ocard-left">
								<div class="ocard-avatar">
									<img src="images/profile-imgs/user.png" alt="">
								</div>
								<div class="ocard-name">
									<h4>Admin</h4>
									<span>My Organisation</span>
								</div>
							</div>
						</div>
						<div class="main-card mt-4">
							<div class="dashboard-wrap-content">
								<div class="d-flex flex-wrap justify-content-between align-items-center p-4">									
								</div>
								<div class="dashboard-report-content">
									<div class="row">
										<div class="col-xl-3 col-lg-6 col-md-6">
											<div class="dashboard-report-card success">
												<div class="card-content">
													<div class="card-content">
														<?php
															$query = "SELECT SUM(price) AS sum FROM bookings";
															$query_res = mysqli_query($conn, $query);
															while ($rows = mysqli_fetch_assoc($query_res))
															{
																$output = $rows['sum'];
															}
															
														?>
														<span class="card-title fs-6">Revenue (NGN)</span>
														<span class="card-sub-title fs-3">&#8358;<?= number_format($output); ?></span>
													</div>
													<div class="card-media">
														<i class="fa-solid fa-money-bill"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-lg-6 col-md-6">
											<div class="dashboard-report-card success">
												<div class="card-content">
													<div class="card-content">
														<span class="card-title fs-6">Bookings</span>
														<span class="card-sub-title fs-3">
															<?php
																$sql = "SELECT count('id') FROM bookings";
																$result = $conn->query($sql);
																$rows=mysqli_fetch_array($result);
																echo "$rows[0]";
															?>
														</span>
													</div>
													<div class="card-media">
														<i class="fa-solid fa-calendar-days"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-lg-6 col-md-6">
											<div class="dashboard-report-card success">
												<div class="card-content">
													<div class="card-content">
														<span class="card-title fs-6">Users</span>
														<span class="card-sub-title fs-3">
															<?php
																$sql = "SELECT count('id') FROM users";
																$result = $conn->query($sql);
																$rows=mysqli_fetch_array($result);
																echo "$rows[0]";
															?>
														</span>
													</div>
													<div class="card-media">
														<i class="fa-solid fa-user-group"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-lg-6 col-md-6">
											<div class="dashboard-report-card success">
												<div class="card-content">
													<div class="card-content">
														<span class="card-title fs-6">Halls</span>
														<span class="card-sub-title fs-3">
															<?php
																$sql = "SELECT count('id') FROM halls";
																$result = $conn->query($sql);
																$rows=mysqli_fetch_array($result);
																echo "$rows[0]";
															?>
														</span>
													</div>
													<div class="card-media">
														<i class="fa-solid fa-home"></i>
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
	<!-- Body End -->

	<!-- AlertJS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	
	<script>
        <?php
        if (isset($_SESSION['message'])) {?>
            alertify.set('notifier','position', 'top-right');
            alertify.success('<?php echo $_SESSION['message']; ?>');
        <?php
            unset($_SESSION['message']);
        }
        ?>
    </script>

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