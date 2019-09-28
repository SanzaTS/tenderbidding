<?php

include("session.php");
include("connection.php"); 

$username = $_SESSION['username'];
   // echo $username;
    $sql = "UPDATE `users` SET `Active`='offline' WHERE `username` = '$username' ";

    if(mysqli_query($con,$sql))
    {
        session_unset();

        session_destroy();
        
        header("location:index.php");
    }
    else{
        echo "Something Went Wrong";
    }

   





?>