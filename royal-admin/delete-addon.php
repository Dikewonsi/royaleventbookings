<?php
	session_start();

	include ("config.php");
    include ("myfunctions.php");

	$id = mysqli_escape_string($conn, $_GET['id']);
    $delete_query= 'DELETE from addons where id = '.$id;
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run)
    {
        redirect("addons.php", "Addon Has Been Deleted");
    }
    else
    {
        redirect("addons.php", "Something Went Wrong");
    }

   

?>