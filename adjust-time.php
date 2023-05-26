<?php 
    session_start();
    include("config.php");
    error_reporting(E_ALL);
	ini_set('display_errors',TRUE);
	$errors = array();


    if(!isset($_SESSION['userid']))
    {
        header("location:sign_in.php");
        exit();
    }

    $userid = $_SESSION['userid'];

    $date = $_SESSION['picked_date'];
       

    if(isset($_POST['adjust']))
    {
        $time = mysqli_escape_string($conn, $_POST['time']);	
        $duration = mysqli_escape_string($conn, $_POST['duration']);	
        
        $check_time_query = "SELECT * from bookings WHERE event_time = '$time' AND event_date = '$date' ";
        $check_time_query_run = mysqli_query($conn, $check_time_query);
        
        if(mysqli_num_rows($check_time_query_run) > 0)
        {
            $errors['email'] = "The Starting time you picked has been choosen! Select another Starting Time ";
        }
        else
        {
            $_SESSION['event_time'] = $time;
            $_SESSION['duration'] = $duration;
	    	header("location:book_event.php");
            exit();
        }
        
        
    }
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Royal Events Booking - Date Checker</title>
		
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
									<li class="breadcrumb-item active" aria-current="page">Create</li>
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
						<div class="main-title text-center checkout-title">
							<h3>Adjust Time</h3>													
						</div>
						<div class="row">
                            <div class="alert alert-warning text-center">
                                <?php
                                    $date = $_SESSION['picked_date'];

                                    $date_check = "SELECT * FROM bookings WHERE event_date = '$date'  ";
                                    $res = mysqli_query($conn, $date_check);
                                    if(mysqli_num_rows($res) > 0)
                                    {
                                        $date_check = "SELECT event_time, duration FROM bookings WHERE event_date = '$date'";
                                        $res = mysqli_query($conn, $date_check);
                                        while($row = $res->fetch_assoc())
                                        {
                                            $event_time = $row['event_time'];
                                            $duration = $row['duration'];                
                                        }
                                        echo "Please be aware that this date has been taken, with an event set to hold by ". $event_time. " For a duration of ". $duration. ". You can however still hold your event but with a different starting time, you can adjust the timing of your event below.";
                                    }
                                ?>
                            </div>
                            <br>                            
                        </div>
                        <div class="row">
                                <?php
                                    if(count($errors) == 1){
                                        ?>
                                        <div class="alert alert-danger text-center">
                                            <?php
                                            foreach($errors as $showerror){
                                                echo $showerror;
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }elseif(count($errors) > 1){
                                        ?>
                                        <div class="alert alert-danger text-center">
                                            <?php
                                            foreach($errors as $showerror){
                                                ?>
                                                <li><?php echo $showerror; ?></li>
                                                <?php
                                            }
                                ?>
                                        </div>
                                <?php
                                    }
                                ?>
                            </div>
					</div>
					<div class="col-xl-6 col-lg-8 col-md-12">
                        <div class="create-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group border_bottom ">
                                            <div class="row">
                                                <div class="form-group border_bottom pt_30 pb_30">
                                                    <label class="form-label fs-16">Adjust the time of your event?*</label>													
                                                    <div class="row g-2">
                                                        <div class="col-md-6">
                                                            <label class="form-label mt-3 fs-6">Picked Date.*</label>																
                                                            <div class="loc-group position-relative">
                                                                <input class="form-control datepicker-here" name="date" data-language="en" required placeholder="<?= $date?>" disabled>
                                                                <span class="absolute-icon"><i class="fa-solid fa-calendar-days"></i></span>
                                                            </div>															
                                                        </div>
                                                        <div class="col-md-6">																		
                                                            <div class="row g-2">
                                                                <div class="col-md-6">
                                                                    <div class="clock-icon">
                                                                        <label class="form-label mt-3 fs-6">Starting Time</label>	
                                                                        <select class="selectpicker"  required name="time" data-size="5" data-live-search="true">
                                                                            <option value="00:00 AM">12:00 AM</option>
                                                                            <option value="00:15 AM">12:15 AM</option>
                                                                            <option value="00:30 AM">12:30 AM</option>
                                                                            <option value="00:45 AM">12:45 AM</option>
                                                                            <option value="01:00 AM">01:00 AM</option>
                                                                            <option value="01:15 AM">01:15 AM</option>
                                                                            <option value="01:30 AM">01:30 AM</option>
                                                                            <option value="01:45 AM">01:45 AM</option>
                                                                            <option value="02:00 AM">02:00 AM</option>
                                                                            <option value="02:15 AM">02:15 AM</option>
                                                                            <option value="02:30 AM">02:30 AM</option>
                                                                            <option value="02:45 AM">02:45 AM</option>
                                                                            <option value="03:00 AM">03:00 AM</option>
                                                                            <option value="03:15 AM">03:15 AM</option>
                                                                            <option value="03:30 AM">03:30 AM</option>
                                                                            <option value="03:45 AM">03:45 AM</option>
                                                                            <option value="04:00 AM">04:00 AM</option>
                                                                            <option value="04:15 AM">04:15 AM</option>
                                                                            <option value="04:30 AM">04:30 AM</option>
                                                                            <option value="04:45 AM">04:45 AM</option>
                                                                            <option value="05:00 AM">05:00 AM</option>
                                                                            <option value="05:15 AM">05:15 AM</option>
                                                                            <option value="05:30 AM">05:30 AM</option>
                                                                            <option value="05:45 AM">05:45 AM</option>
                                                                            <option value="06:00 AM">06:00 AM</option>
                                                                            <option value="06:15 AM">06:15 AM</option>
                                                                            <option value="06:30 AM">06:30 AM</option>
                                                                            <option value="06:45 AM">06:45 AM</option>
                                                                            <option value="07:00 AM">07:00 AM</option>
                                                                            <option value="07:15 AM">07:15 AM</option>
                                                                            <option value="07:30 AM">07:30 AM</option>
                                                                            <option value="07:45 AM">07:45 AM</option>
                                                                            <option value="08:00 AM">08:00 AM</option>
                                                                            <option value="08:15 AM">08:15 AM</option>
                                                                            <option value="08:30 AM">08:30 AM</option>
                                                                            <option value="08:45 AM">08:45 AM</option>
                                                                            <option value="09:00 AM">09:00 AM</option>
                                                                            <option value="09:15 AM">09:15 AM</option>
                                                                            <option value="09:30 AM">09:30 AM</option>
                                                                            <option value="09:45 AM">09:45 AM</option>
                                                                            <option value="10:00 AM" selected="selected">10:00 AM</option>
                                                                            <option value="10:15 AM">10:15 AM</option>
                                                                            <option value="10:30 AM">10:30 AM</option>
                                                                            <option value="10:45 AM">10:45 AM</option>
                                                                            <option value="11:00 AM">11:00 AM</option>
                                                                            <option value="11:15 AM">11:15 AM</option>
                                                                            <option value="11:30 AM">11:30 AM</option>
                                                                            <option value="11:45 AM">11:45 AM</option>
                                                                            <option value="12:00 PM">12:00 PM</option>
                                                                            <option value="12:15 PM">12:15 PM</option>
                                                                            <option value="12:30 PM">12:30 PM</option>
                                                                            <option value="12:45 PM">12:45 PM</option>
                                                                            <option value="13:00 PM">01:00 PM</option>
                                                                            <option value="13:15 PM">01:15 PM</option>
                                                                            <option value="13:30 PM">01:30 PM</option>
                                                                            <option value="13:45 PM">01:45 PM</option>
                                                                            <option value="14:00 PM">02:00 PM</option>
                                                                            <option value="14:15 PM">02:15 PM</option>
                                                                            <option value="14:30 PM">02:30 PM</option>
                                                                            <option value="14:45 PM">02:45 PM</option>
                                                                            <option value="15:00 PM">03:00 PM</option>
                                                                            <option value="15:15 PM">03:15 PM</option>
                                                                            <option value="15:30 PM">03:30 PM</option>
                                                                            <option value="15:45 PM">03:45 PM</option>
                                                                            <option value="16:00 PM">04:00 PM</option>
                                                                            <option value="16:15 PM">04:15 PM</option>
                                                                            <option value="16:30 PM">04:30 PM</option>
                                                                            <option value="16:45 PM">04:45 PM</option>
                                                                            <option value="17:00 PM">05:00 PM</option>
                                                                            <option value="17:15 PM">05:15 PM</option>
                                                                            <option value="17:30 PM">05:30 PM</option>
                                                                            <option value="17:45 PM">05:45 PM</option>
                                                                            <option value="18:00 PM">06:00 PM</option>
                                                                            <option value="18:15 PM">06:15 PM</option>
                                                                            <option value="18:30 PM">06:30 PM</option>
                                                                            <option value="18:45 PM">06:45 PM</option>
                                                                            <option value="19:00 PM">07:00 PM</option>
                                                                            <option value="19:15 PM">07:15 PM</option>
                                                                            <option value="19:30 PM">07:30 PM</option>
                                                                            <option value="19:45 PM">07:45 PM</option>
                                                                            <option value="20:00 PM">08:00 PM</option>
                                                                            <option value="20:15 PM">08:15 PM</option>
                                                                            <option value="20:30 PM">08:30 PM</option>
                                                                            <option value="20:45 PM">08:45 PM</option>
                                                                            <option value="21:00 PM">09:00 PM</option>
                                                                            <option value="21:15 PM">09:15 PM</option>
                                                                            <option value="21:30 PM">09:30 PM</option>
                                                                            <option value="21:45 PM">09:45 PM</option>
                                                                            <option value="22:00 PM">10:00 PM</option>
                                                                            <option value="22:15 PM">10:15 PM</option>
                                                                            <option value="22:30 PM">10:30 PM</option>
                                                                            <option value="22:45 PM">10:45 PM</option>
                                                                            <option value="23:00 PM">11:00 PM</option>
                                                                            <option value="23:15 PM">11:15 PM</option>
                                                                            <option value="23:30 PM">11:30 PM</option>
                                                                            <option value="23:45 PM">11:45 PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label mt-3 fs-6">Duration</label>	
                                                                    <select class="selectpicker" required name="duration" data-size="5" data-live-search="true">
                                                                        <option value="1hr">1hr</option>
                                                                        <option value="2hr">2hr</option>
                                                                        <option value="3hr">3hr</option>
                                                                        <option value="4hr">4hr</option>
                                                                        <option value="5hr">5hr</option>
                                                                        <option value="6hr">6hr</option>
                                                                        <option value="7hr">7hr</option>
                                                                        <option value="8hr">8hr</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>															
                                            </div>
                                        </div>

                                        <div class="step-footer step-tab-pager mt-4">
                                            <button name="adjust" type="submit" class="btn btn-default btn-hover steps_btn">Check Date</button>
                                            <a href="index.php" type="submit" class="btn btn-default btn-hover steps_btn">Cancel</a>
                                        </div>
                                    </form>
                                    <div class="loc-group position-relative">
                                        
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
	<script src="vendor/ckeditor5/ckeditor.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/datepicker.js"></script>
	<script src="js/i18n/datepicker.en.js"></script>
	<script src="js/night-mode.js"></script>
</body>
</html>