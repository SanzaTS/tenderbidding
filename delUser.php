<?php
  include("session.php");
  include("connection.php");

  $username = $_GET['id'];
  
  $user ="SELECT b.id FROM user u,bidder b WHERE b.user_id = u.id AND username = '$username'";

  $results = mysqli_query($con,$user);

  while($row = mysqli_fetch_array($results))
  {
     $id = $row['id'];
  }
  
 
  if(mysqli_query($con,"DELETE FROM `bid` WHERE `bidder_id` = $id ") or die(mysqli_error($con)))
  {
     if( mysqli_query($con,"DELETE FROM `bidder` WHERE `id` = $id") or die(mysqli_error($con)))
     { 
         if(mysqli_query($con,"DELETE FROM `user` WHERE `username` = '$username' ") or die(mysqli_error($con)))
         {
            header("location:users.php");;
         }
         else
         { 
          ?> 
          <script>
           alert('something went wrong from bidding table');
          window.location.href='users.php?fail';
          </script>
    
        <?php

         }
     }
     else
     {  
      ?> 
      <script>
       alert('something went wrong from BIDDERS table');
      window.location.href='users.php?fail';
      </script>

    <?php

     }
    
  }
  else
  { 
    ?> 
      <script>
       alert('something went wrong from users');
      window.location.href='users.php?fail';
      </script>

    <?php

  }
 

  header("location:users.php");;
?>