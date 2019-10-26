<?php

include("session.php");
include("connection.php");

$id = $_GET['id'];
$approve = "UPDATE admin SET status = 'Approved' WHERE id = $id";

if(mysqli_query($con,$approve))
{
     header("location:application.php");
}
else{
    ?> 
     <script>
        alert("Something went wrong");
        window.location.href='application.php?fail';
     </script>
    <?php
}

?>