<?php 
    session_start();
    include("config.php");    

    $userid = $_SESSION['userid'];
    

     $date = '2022-11-30'	;

	$date_check = "SELECT * FROM bookings WHERE event_date = '$date'";
     $res = mysqli_query($conn, $date_check);
     if(mysqli_num_rows($res) > 0)
     {
          
     }
     else
     {
          echo 200;
     }

     $errors['email'] = "Oops that date has been taken. with an event set to hold by ". $event_time. " For a duration of ". $event_duration;
	

     $date_check = "SELECT event_time, duration FROM bookings WHERE event_date = '$date'";
	    $res = mysqli_query($conn, $date_check);
	    while($row = $result->fetch_assoc())
		{
			$event_time = $row['event_time'];

			echo $event_time;
	   	}
?>