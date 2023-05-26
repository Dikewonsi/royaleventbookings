<?php
	session_start();

	include ("config.php");
    include('myfunctions.php');

	$id = mysqli_escape_string($conn, $_GET['coupon_id']);
    $status = 'Disabled';
    $update_query= "UPDATE coupon SET status='$status' WHERE coupon_id = '$id' ";
    $update_query_run = mysqli_query($conn, $update_query);

    if($update_query_run)
    {
        redirect("coupons.php", "Coupon Has Been Disabled");
    }
    else
    {
        redirect("coupons.php", "Something Went Wrong.");
    }

?>