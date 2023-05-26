<?php

    session_start();
    include ("config.php");
    include ("myfunctions.php");    

    if (isset($_POST['book_event1']))
    {
        $_SESSION['picked_date'];

        $event_name = mysqli_escape_string($conn, $_POST['event_name']); 
        $category = mysqli_escape_string($conn, $_POST['category']);                       
               
        $_SESSION['event_name'] = $event_name;
        $_SESSION['event_category'] = $category;  
        
        header("Location:select_hall.php");
    }

    
    else if(isset($_POST['book_event2']))
    {
        $_SESSION['picked_date'];
        
        //payment_type = Hall Name
        $payment_type = mysqli_escape_string($conn, $_POST['payment_type']);

        if ($payment_type != '')
        {
            if ($payment_type == 'Annex A') {

                $check_email = "SELECT price FROM halls WHERE name = '$payment_type' ";
                $res = mysqli_query($conn, $check_email);
                if(mysqli_num_rows($res) > 0)
                {
                    $fetch_data = mysqli_fetch_assoc($res);
                    $price = $fetch_data['price'];  

                    $_SESSION['hall'] = $payment_type;
                    $_SESSION['price'] = $price;
                    $_SESSION['event_name'];
                    $_SESSION['event_category'];       
                    $_SESSION['event_time'];
                    $_SESSION['event_duration'];

                    redirect("checkout.php", "Category Added Successfully");                  
                }                                 
            } 
            else if($payment_type == 'Annex B')
            {
                $check_email = "SELECT price FROM halls WHERE name = '$payment_type' ";
                $res = mysqli_query($conn, $check_email);
                 if(mysqli_num_rows($res) > 0)
                 {
                    $fetch_data = mysqli_fetch_assoc($res);
                    $price = $fetch_data['price'];

                    $_SESSION['hall'] = $payment_type;
                    $_SESSION['price'] = $price;
                    $_SESSION['event_name'];
                    $_SESSION['event_category'];       
                    $_SESSION['event_time'];
                    $_SESSION['event_duration'];

                    redirect("checkout.php", "Category Added Successfully");                    
                 }
                
            }
        }

    }       
    
    else if(isset($_POST['submitHallBtn']))
        {
            $hall =  $_POST['hall_name'];

            $check_price = "SELECT price FROM halls WHERE name = '$hall' ";
            $res = mysqli_query($conn, $check_price);
            if(mysqli_num_rows($res) > 0)
            {
                $fetch_data = mysqli_fetch_assoc($res);
                $price = $fetch_data['price'];

                $_SESSION['price'] = $price;

                $userid = $_SESSION['userid'];
                //Get Fullname of Client
                $fname = $_SESSION['fname'];
                $lname = $_SESSION['lname'];
                $fullname = $fname.' '.$lname;
                $email = $_SESSION['email'];
                $phone = $_SESSION['phone'];

                //Get Event Date,Day,Time Duration values
                $event_date = $_SESSION['picked_date'];
                $event_day = date("D, d M Y", strtotime($event_date));
                $event_time = $_SESSION['event_time'];
                $duration = $_SESSION['duration'];

                //Get Event Details
                $event_name = $_SESSION['event_name'];
                $category = $_SESSION['event_category'];

                $status = 'booked';
                $event_status = 'booked';
                $ref = 0;                                                            

                $insert_query = "INSERT INTO bookings (userid, fullname, email, phone, event_day, event_date, event_name, category, event_time, duration, hall, price, status, event_status, reference)
                VALUES ('$userid', '$fullname', '$email', '$phone', '$event_day', '$event_date', '$event_name', '$category', '$event_time', '$duration', '$hall', '$price', '$status', '$event_status', '$ref')";

                $insert_query_run = mysqli_query($conn, $insert_query);

                if($insert_query_run)
                {
                    $booking_id = mysqli_insert_id($conn);
                    $_SESSION['booking_id'] = $booking_id;
                    header("Location:booking-made.php");
                }
            }
        }

    else
    {
        header("location: index.php");
    }