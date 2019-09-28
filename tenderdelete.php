<?php

include("session.php");
include("connection.php");

$id =$_GET['id'];

mysqli_query($con,"DELETE FROM `tender` WHERE `tenderId`= '$id'
");

header("location:tenders.php");


?>