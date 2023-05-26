<?php
    include('config.php');
    include('myfunctions.php');

    if($_GET['id'] == '')
    {
        header("Location:event-category.php");
    }
    else
    {
        $id = $_GET['id'];
        
        $delete_cat_query = "DELETE FROM event_category WHERE id = '$id' ";
        $delete_cat_query_run = mysqli_query($conn, $delete_cat_query);

        if($delete_cat_query_run)
        {
            redirect("event-category.php", "Event Category Deleted");
        }
        else
        {
            redirect("event-category.php", "Something went wrong");
        }
    }
?>