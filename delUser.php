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

  mysqli_query($con,"DELETE FROM users WHERE username = $username");
  mysqli_query($con,"DELETE FROM bidder WHERE id = $id");

  header("location:users.php");;
?>