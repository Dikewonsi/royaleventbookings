<?php
	
    include('config.php');
    session_start();
    
	$coupon_code = $_POST['coupon'];
	$price = $_POST['price'];

    


    $coupon_query = "SELECT * FROM coupon WHERE coupon_code = '$coupon_code' AND status = 'Valid'";
    $coupon_query_run = mysqli_query($conn, $coupon_query);

	
    $count = mysqli_num_rows($coupon_query_run);
	$fetch = mysqli_fetch_array($coupon_query_run);
	$array = array();
	if($count > 0){
		$discount = $fetch['discount'] / 100;
		$total = $discount * $price;
		$_SESSION['discount'] = $fetch['discount'];
		$_SESSION['new_price'] = $price - $total;

        $_SESSION['old_price'] = $price;

        $_SESSION['coupon_code'] = $coupon_code;
                    
        header("Location:../discount-checkout.php");	
		
		
	}else
	{
		echo "error";
	}
	
	
?>