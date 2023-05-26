<?php

	include('config.php');
	session_start();

	$item_name = $_POST['item_name'];
	$item_price= $_POST['item_price'];
	$item_number = $_POST['item_number'];	
	$count=0;

	$total_amount = 0;
	$grand_total = 0;


	//GET booking id

	$booking_id = $_SESSION['booking_id'];

	
	foreach( $item_name  as $key => $n )
	{
		if($item_number[$key] !== '0' )
		{

			// $grand_total += $item_price[$key] * $item_number[$key];		
            
            // $_SESSION['grand_total'] = $grand_total;

			$total = $item_price[$key] * $item_number[$key];
							
			$booking_id = $_SESSION['booking_id'];
			

			$insert_query = "INSERT INTO  booking_addons (booking_id, name, price, qty, tprice) VALUES ('$booking_id', '$n', '$item_price[$key]', '$item_number[$key]', '$total')";
			$insert_query_run = mysqli_query($conn, $insert_query);
			$count++;		
					
		}
	}
	if($insert_query_run)
			{
				header("Location:../showaddon.php");
				$count++;
			}
			else
			{
				echo 500;
			}
	if ($count=='0')
	{
		echo "No add on was choosen";
	}

?>