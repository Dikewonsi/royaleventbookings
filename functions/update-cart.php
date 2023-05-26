<?php    

    session_start();    
	include("config.php");
    
    if(isset($_GET['update_qty']))
    {
        $id = $_GET['id'];
        $qty = $_GET['qty'];    
        $price = $_GET['price'];

        $tprice = $qty*$price;
        


        if(is_numeric($qty) && $qty > 0)
        {
            $cart_query = "UPDATE booking_addons set qty=$qty, tprice=$tprice WHERE id=$id  ";
            $cart_query_run = mysqli_query($conn, $cart_query);

            if($cart_query_run)
            {
                header("Location: ../showaddon.php");
            }
        }
    }
?>