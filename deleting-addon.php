<?php
	session_start();

	include ("config.php");

	$id = mysqli_escape_string($conn, $_GET['id']);
    $sql= 'DELETE from booking_addons where id = '.$id;

    if ($conn->query($sql) === TRUE)
    {
        header("Location: showaddon.php");
	}


$conn->close();

?>