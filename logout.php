<?php

include("session.php");
include("connection.php");

$username = $_SESSION['username'];

     mysqli_query($con,"UPDATE users SET Active = 'offline' WHERE username = '$username' ");

    session_unset();

    session_destroy();
    
    header("location:index.php");





?>