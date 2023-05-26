<?php
	session_start();

	include ("config.php");
    include ("myfunctions.php");

	$id = mysqli_escape_string($conn, $_GET['coupon_id']);
    $delete_query= 'DELETE from coupon where coupon_id = '.$id;
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run)
    {
        redirect("coupons.php", "Coupon Has Been Deleted");
    }
    else
    {
        redirect("coupons.php", "Something Went Wrong");
    }

   

?>