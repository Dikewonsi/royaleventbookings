<?php
    session_start();
    include('config.php');

    if(isset($_GET['id']))
    {
        $booking_id = $_GET['id'];

        $new_price = $_SESSION['new_price'];

        $status = 'Saved';
        
        $discount = $_SESSION['discount'];                       

        $reference = 'REB'.rand(20220001,20229000);
        

        $update_payment = "UPDATE bookings SET reference='$reference', status='$status', price='$new_price', discount='$discount' WHERE id='$booking_id' ";
        $update_payment_run = mysqli_query($conn, $update_payment);

        if (!$update_payment_run)
        {
        # code...
        echo "There was a problem in your code". mysqli_error($conn);
        }
        else
        {
        header("Location: booking_confirmed.php");
        }
    }
    else
    {
        header("Location: checkout.php");
    }

    
?>