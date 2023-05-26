<?php 

	session_start();
	include('config.php');
	include('myfunctions.php');
	error_reporting(E_ALL);
    ini_set('display_errors',TRUE); 


    if (isset($_POST['edit_booking']))
	{
		$id = mysqli_escape_string($conn, $_POST['id']);
		$status = mysqli_escape_string($conn, $_POST['status']);

		$modified_date = date('d-m-y h:i:s');

		$date_check = "SELECT * FROM bookings WHERE event_date = '$date'";
		$res = mysqli_query($conn, $date_check);
		if(mysqli_num_rows($res) > 0)
		{
			redirect("bookings.php?id= $id", "Unfortunately that date is not available. Please try another one.");	        
		}

		$event_day = date("D, d M Y", strtotime($date));

		$update_booking_query=" UPDATE bookings SET event_status='$status', modified_at='$modified_date' WHERE id ='$id'  ";

		$update_booking_query_run = mysqli_query($conn, $update_booking_query);

		if ($update_booking_query_run)
		{
			redirect("bookings.php", "Booking Edited Successfully");
		}
		else
		{
			redirect("bookings.php", "Something went wrong");	
		}
	}

    else if(isset($_POST['edit_hall']))
		{
			$id = mysqli_escape_string($conn, $_POST['id']);
			$name = mysqli_escape_string($conn, $_POST['name']);
			$price = mysqli_escape_string($conn, $_POST['price']);
			$capacity = mysqli_escape_string($conn, $_POST['capacity']);

			$modified_date = date('d-m-y h:i:s');

			$update_hall_query=" UPDATE halls SET name='$name', price='$price', capacity='$capacity', modified_at='$modified_date' WHERE id ='$id'  ";

			$update_hall_query_run = mysqli_query($conn, $update_hall_query);

			if ($update_hall_query_run)
			{
				redirect("halls.php", "Hall Edited Successfully");
			}
			else
			{
				redirect("halls.php", "Something went wrong");	
			}


		}

    else if(isset($_POST['search_booking']))
		{
			$reference = mysqli_escape_string($conn, $_POST['reference']);	

			$reference_check = "SELECT * FROM bookings WHERE reference = '$reference'";
			$result = mysqli_query($conn, $reference_check);
			if(mysqli_num_rows($result) > 0)
			{
				while($rows = mysqli_fetch_assoc($result))
				{   
					$id = $rows['id']; 
				}
				redirect("view-booking.php?id= $id", "Here is your result");	        
			}
			else
			{
				redirect("search-booking.php", "Nothing Found");	        
			}


		}

    else if(isset($_POST['edit_admin']))
		{
			$id = mysqli_escape_string($conn, $_POST['id']);
			$username = mysqli_escape_string($conn, $_POST['username']);
			$password = mysqli_escape_string($conn, $_POST['password']);

			$modified_date = date('d-m-y h:i:s');

			$update_admin_query=" UPDATE admin SET username='$username', password='$password', modified_at='$modified_date' WHERE id ='$id'  ";

			$update_admin_query_run = mysqli_query($conn, $update_admin_query);

			if ($update_admin_query_run)
			{
				redirect("profile.php", "Admin Details Updated");
			}
			else
			{
				redirect("profile.php", "Something went wrong");	
			}


		}

	else if(isset($_POST['addEventCatBtn']))
		{
			$cat_name = mysqli_escape_string($conn, $_POST['cat_name']);

			$add_cat = "INSERT INTO  event_category (name) VALUES ('$cat_name')";

			$insert_check = mysqli_query($conn, $add_cat);
			if($insert_check)
			{
				redirect("event-category.php", "New Event Category Added");
			}
			else
			{
				redirect("event-category.php", "Something went wrong");
			}

		}

	else if(isset($_POST['editEventBtn']))
		{
			$id = $_POST['id'];
			$name = $_POST['name'];

			$edit_category_query = "UPDATE event_category SET name='$name' WHERE id = '$id'";
			$edit_category_query_run = mysqli_query($conn, $edit_category_query);

			if($edit_category_query_run)
			{
				redirect("event-category.php", "Event Category Has Been Edited");
			}
			else
			{
				redirect("event-category.php", "Something went wrong");
			}
		}


	else if(isset($_POST['generate']))
		{
			$coupon = $_POST['coupon'];
			$percentage = $_POST['percentage'];
			$status = 'Valid';
			$query = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon'") or die(mysqli_error());
			$row = mysqli_num_rows($query);
			
			if($row > 0)
			{
				redirect("coupons.php", "Something went wrong");
			}
			else
			{
				mysqli_query($conn, "INSERT INTO `coupon` VALUES('', '$coupon', '$percentage', '$status')") or die(mysqli_error());
				redirect("coupons.php", "Coupon Generated Successfully");
			}
		}

	
	else if(isset($_POST['add_addon']))
		{
			$name = $_POST['addon'];
			$price = $_POST['price'];

			$insert_query = "INSERT INTO addons (name, price) VALUES ('$name', '$price') ";
			$insert_query_run = mysqli_query($conn, $insert_query);
			if($insert_query_run)
			{
				redirect("addons.php", "New Addon Added Successfully");
			}
			else
			{
				redirect("addons.php", "Something went wrong");
			}
		
		}
	
	else if(isset($_POST['editCautionBtn']))
		{
			$id = $_POST['id'];
			$price = $_POST['price'];

			$edit_caution_query = "UPDATE caution_fee SET price='$price' WHERE id = '$id'";
			$edit_caution_query_run = mysqli_query($conn, $edit_caution_query);

			if($edit_caution_query_run)
			{
				redirect("caution_fee.php", "Caution Fee Has Been Edited");
			}
			else
			{
				redirect("caution_fee.php", "Something went wrong");
			}
		}

    else
    {
    	header("location: index.php");
    }

?>