<?php
include("session.php");
include("connection.php");

$username = $_SESSION['username'];

$error = "";
if(isset($_POST['save']))
{
    $tender_id = mysqli_real_escape_string($con,$_POST['id']);
    $title = mysqli_real_escape_string($con,$_POST['title']);
    $description = mysqli_real_escape_string($con,$_POST['description']);
    $description2 = mysqli_real_escape_string($con,$_POST['description2']);
    $catergory= mysqli_real_escape_string($con,$_POST['catergory']);
    $date = mysqli_real_escape_string($con,$_POST['date']);
    $minimum= mysqli_real_escape_string($con,$_POST['minimum']);
    $maximum = mysqli_real_escape_string($con,$_POST['maximum']);
   // $admin_id =
    

    if(!empty($title)||!empty($description)||!empty($description2)||empty($catergory)||empty($date)||!empty($minimum)||!empty($maximum))
    {
       
       $query = ("UPDATE `tender` SET`tender_title`='$title',`short_description`='$description',`full_description`='$description2',
       `due_date`='$date',`min_budget`=$minimum,`max_budget`=$maximum WHERE tenderId = '$tender_id'");
        if(mysqli_query($con,$query))
        {
          $error = "Successfully updated";
          header("location:tenders.php");
        }
       else{
         $error = "Something went wrong";
       }
         
    }
    else{
       $error="All fields must be filled";
    }

}
