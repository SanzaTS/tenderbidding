<?php

include("session.php");
include("connection.php");

$username = $_SESSION['username'];

$id = $_GET['id'];

$query = " SELECT b.id FROM bidder b,users u WHERE b.user_id = u.id AND u.username = '$username'";
       
      $rs = mysqli_query($con,$query);
      while($ln = mysqli_fetch_array($rs))
      {
        $uid = $ln['id'];
      }

      $del = "DELETE FROM bidding WHERE bidder_no = $uid AND tender_no = '$id'";

      if(mysqli_query($con,$del))
      {
          header("location:allbids.php");
      }
      else{
        ?>
        <script>
       alert('something went wrong could withdraw from your bid');
      window.location.href='allbids.php?fail';
      </script>
  
      <?php
      }
        


?>