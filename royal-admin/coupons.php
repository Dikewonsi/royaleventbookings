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
		<title>Royal Event Bookings - Coupons</title>
		
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
    <!-- Invite Team Member Model Start-->
	<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addCategoryModalLabel">Generate Coupon Code</h5>
					<button type="button" class="close-model-btn" data-bs-dismiss="modal" aria-label="Close"><i class="uil uil-multiply"></i></button>
				</div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="model-content main-form">
                            <div class="col-lg-12 col-md-12">
								<div class="gift-coupon-icon mt-5 pb-5">
									<img src="images/present-box.png" alt="">																						
								</div>
							</div>
                            <div class="form-group mt-30">
                                <label class="form-label">Coupon Code</label>
                                <input class="form-control h_40" type="text" name="coupon" id="coupon" readonly="readonly" required="required">
                            </div>
                            <br>		
                            <button type="button" id="generate" class="main-btn min-width btn-hover h_40">Generate</button>
                            <div class="form-group mt-30">
                                <label class="form-label">Percentage %</label>
                                <input class="form-control h_40" type="number" name="percentage" placeholder="Enter Percentage" required>
                            </div>											
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="co-main-btn min-width btn-hover h_40" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="generate" class="main-btn min-width btn-hover h_40">Save</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
	<!-- Invite Team Member Model End-->

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
                    <div class="main-card mt-5">
                        <div class="dashboard-wrap-content p-4">
                            <div class="d-md-flex flex-wrap align-items-center">
                                <div class="nav custom2-tabs btn-group" role="tablist">
                                    <div class="d-main-title">
                                        <h3><i class="fa-solid fa-ticket me-3"></i>All Coupons</h3>
                                    </div>
                                </div>
                                <div class="rs ms-auto mt_r4">
                                    <button class="main-btn btn-hover h_40 w-100" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fa-solid fa-plus me-3"></i>Generate Coupon</button>
                                </div>
                            </div>
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
															<th scope="col">Coupon Code</th>
															<th scope="col">Discount</th>
                                                            <th scope="col">Status</th>
															<th scope="col">Action</th>															
														</tr>
														<?php
				                                            $sql = "SELECT * from coupon";
				                                            $result = $conn->query($sql);
				                                            while ($rows=mysqli_fetch_assoc($result)){
				                                            
				                                        ?>
													</thead>
													<tbody>
														<tr>															
															<td><?= $rows['coupon_code'];?></td>										
															<td><?= $rows['discount'];?></td>
															<td><?= $rows['status'];?></td>                                                            
															<td><a href="delete-coupon.php?coupon_id=<?= $rows['coupon_id'];?>"><i class="fa-solid fa-trash-can me-3"></i></a></td>						
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

    <script type="text/javascript">
	$(document).ready(function(){
		$('#generate').on('click', function(){
			$.get("get-coupon.php", function(data){
				$('#coupon').val(data);
			});
		});
	});
    </script>

</body>
</html>