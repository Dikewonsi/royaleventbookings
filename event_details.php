<?php 
	session_start();
    include("config.php");
    include("myfunctions.php");

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
		<title>Royal Event Bookings - Event Details</title>
		
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
									<li class="breadcrumb-item"><a href="profile.php">My Accounnt</a></li>
									<li class="breadcrumb-item active" aria-current="page">Event Details</li>
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
					<?php 
	                    if (isset($_GET['id']))
	                    {
	                        $id = $_GET['id'];
	                        $bookings = getByID("bookings", $id);

	                        if (mysqli_num_rows($bookings) > 0)
	                        {
	                            $data = mysqli_fetch_array($bookings);
	                                                            
	                ?>
					<div class="col-xl-12 col-lg-12 col-md-12">
						<div class="event-top-dts">							
							<div class="event-top-dt">
								<h3 class="event-main-title"><?= $data['event_name'];?>, <?= $data['event_day'];?> at <?= $data['event_time'];?></h3>
								<div class="event-top-info-status">
									<span class="event-type-name"><i class="fa-solid fa-location-dot"></i><?= $data['hall'];?></span>
									<span class="event-type-name details-hr">Starts on <span class="ev-event-date"><?= $data['event_day'];?>, <?= $data['event_time'];?></span></span>
									<span class="event-type-name details-hr"><?= $data['duration'];?></span>
								</div>
							</div>
						</div>
					</div>										
					<div class="col-xl-12 col-lg-5 col-md-12">
						<div class="main-card event-right-dt">
							<div class="bp-title">
								<h4>Event Details</h4>
							</div>
							<div class="time-left">
								<div class="countdown">
									<div class="countdown-item">
										<span id="day"></span>days
									</div>  
									<div class="countdown-item">							
										<span id="hour"></span>Hours
									</div>
									<div class="countdown-item">
										<span id="minute"></span>Minutes
									</div> 
									<div class="countdown-item">
										<span id="second"></span>Seconds
									</div>														
								</div>
							</div>
							<div class="event-dt-right-group mt-5">
								<div class="event-dt-right-icon">
									<i class="fa-solid fa-circle-user"></i>
								</div>
								<div class="event-dt-right-content">
									<h4>Organised by</h4>
									<h5><?= $data['fullname'];?></h5>
								</div>
							</div>
							<div class="event-dt-right-group">
								<div class="event-dt-right-icon">
									<i class="fa-solid fa-calendar-day"></i>
								</div>
								<div class="event-dt-right-content">
									<h4>Date and Time</h4>
									<h5><?= $data['event_day'];?> <?= $data['event_time'];?></h5>									
								</div>
							</div>
							<div class="event-dt-right-group">
								<div class="event-dt-right-icon">
									<i class="fa-solid fa-location-dot"></i>
								</div>
								<div class="event-dt-right-content">
									<h4>Location</h4>
									<h5 class="mb-0"><?= $data['hall'];?></h5>
								</div>
							</div>
							<div class="select-tickets-block">																
								<div class="xtotel-tickets-count">
									<div class="x-title">Total Paid</div>
									<h4><span>&#8358;<?= number_format($data['price']); ?></span></h4>
								</div>
							</div>
							<div class="booking-btn">
								<a href="profile-invoice.php?id= <?= $data['id'];?>" class="main-btn btn-hover w-100">View Receipt</a>
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

	<?php		
		$date = $data['event_date'];
	?>


	<?php
		                    }
		                    else
		                    {
		                        echo "Event not found";
		                    }                        
		                }
		                else
		                {
		                    echo "Event ID missing";
		                }
		            ?>


	
	<script type="text/javascript">
		
	(function () {
	  const second = 1000,
	        minute = second * 60,
	        hour = minute * 60,
	        day = hour * 24;

	  //I'm adding this section so I don't have to keep updating this pen every year :-)
	  //remove this if you don't need it
	  let today = new Date(),
	      dd = String(today.getDate()).padStart(2, "0"),
	      mm = String(today.getMonth() + 1).padStart(2, "0"),
	      yyyy = today.getFullYear(),
	      nextYear = yyyy + 1,
	      dayMonth = "<?php echo $date; ?>",
	      event = dayMonth
	  
	  today = yyyy + "/" + mm + "/" + dd;
	  if (today > event) {
	    event = dayMonth;
	  }
	  //end
	  
	  const countDown = new Date(event).getTime(),
	      x = setInterval(function() {    

	        const now = new Date().getTime(),
	              distance = countDown - now;

	        document.getElementById("day").innerText = Math.floor(distance / (day)),
	          document.getElementById("hour").innerText = Math.floor((distance % (day)) / (hour)),
	          document.getElementById("minute").innerText = Math.floor((distance % (hour)) / (minute)),
	          document.getElementById("second").innerText = Math.floor((distance % (minute)) / second);

	        //do something later when date is reached
	        if (distance < 0) {
	          document.getElementById("headline").innerText = "Booking Ends!";
	          document.getElementById("countdown").style.display = "none";
	          document.getElementById("content").style.display = "block";
	          clearInterval(x);
	        }
	        //seconds
	      }, 0)
	  }());

	</script>

	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>	
	<script src="js/custom.js"></script>	
	<script src="js/night-mode.js"></script>
	
</body>
</html>