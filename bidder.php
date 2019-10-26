<?php
include("session.php");
include("connection.php");

$username = $_SESSION['username'];


$date = "SELECT * FROM tender WHERE DATEDIFF(NOW(),`due_date`) >= 0";
$results = mysqli_query($con,$date);

$rows = mysqli_num_rows($results);
//echo $rows;
if($rows  > 0)
{
  //$id = array();
  for($i =0;$i <= $rows;$i++)
  {
     
    while($line = mysqli_fetch_array($results))
    {
     $id = array($line['tenderId']);
     // echo $id[$i];


      $fetch = "SELECT * FROM `bidding` WHERE amount = (SELECT MAX(amount) FROM bidding WHERE `tender_no` = '$id[$i]')";
      $bidder = mysqli_query($con,$fetch) or die(mysqli_error($con));
   
      while($user = mysqli_fetch_array($bidder))
      {
         $winner =array($user['bidder_id']) ;

         //echo "id is :" .$winner ."<br>";

         $win = "UPDATE bidding SET status = 'Won' WHERE tender_no = '$id[$i]'
         AND bidder_id = $winner[$i]";

          mysqli_query($con,$win);

          $name = "SELECT u.username FROM users u,bidder b WHERE u.id = b.user_id AND b.id =$winner[$i]";
          $res2 = mysqli_query($con,$name);

          while($rows = mysqli_fetch_array($res2))
          {
             $Reciever = array($rows['username']);

               
                $massage = "Cogratulation You have just been awarded a tender,<a href=\" bidstats.php\">Clic here to check the awarde bids</a>";
                
                $sender = "Admin";
                $sendDate = date("d/m/Y");
                $sentTime= date("h:i:s");


                $val ="SELECT * FROM chat WHERE reciever = '$Reciever[$i]' AND Msg = '$massage'";
                $res1 = mysqli_query($con,$val);
                
               
                      $del = "DELETE FROM chat WHERE Msg = '$massage'";
                      mysqli_query($con,$del);
                       $sorce = array($sender);
                       $msg =array($massage);
                       $time = array($sentTime);
                       $date1 = array($sendDate);
                    //  echo $Reciever[$i];
                    //  echo $date1[$i];
                      
                        $insert = "INSERT INTO `chat`( `sender`, `reciever`, `Msg`, `date`, `time`) VALUES ";
                        for($x =0; $x < count($Reciever);$x++)
                        {
                          $array[] = "('$sorce[$x]','$Reciever[$x]','$msg[$x]','$date1[$x]','$time[$x]')";
                        }
                         $insert .= implode(',', $array);
                         mysqli_query($con,$insert);
                      
                     
                   


                     
             
                

           }
      }
       
    }
   
   
   // echo $id[$i];
  }
   


  


} 




?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tender Bidding System</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="assets/ico/favicon.png">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BIDDER<sup>(TBS)</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="ibidder.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
       BIDDER DASHBORD
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Action</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
           <h6 class="collapse-header">Actions to be taken:</h6>
          <a class="collapse-item" href="bidder.php">Make Bid</a>
            <a class="collapse-item" href="chat.php">Send Massage</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Views</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Views and Genderate Report:</h6>
          <a class="collapse-item" href="bidstats.php">Status</a>
            <a class="collapse-item" href="allbids.php">All Bids</a>
            <a class="collapse-item" href="maessage.php">Notification</a>
           
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

  

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


           
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username."[-BIDDER-]";  ?></span>
                <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
              
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <!-- Page Heading -->
           <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Tenders</h1>
            
          </div>

             
          <!-- Content Row -->
          <div class="row">
          <div class="col-lg-12">



<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
  <!-- Card Header - Dropdown -->
  <?php 
      
      $query = " SELECT b.industry FROM bidder b,users u WHERE b.user_id= u.id AND u.username = '$username'";
       
      $rs = mysqli_query($con,$query);
      while($ln = mysqli_fetch_array($rs))
      {
        $cat = $ln['industry'];
      }
        
      $sql = "SELECT * FROM tender WHERE DATEDIFF(NOW(),`due_date`) <= 0 AND category = '$cat'";

      $res = mysqli_query($con,$sql);

      while($row = mysqli_fetch_array($res))
      {
         $id = $row['tenderId'];
         $title = $row['tender_title'];
         $date = $row['due_date'];
         $desc = $row['short_description'];
         $desc2 = $row['full_description'];
         $catergory = $row['category'];
         $min = $row['min_budget'];
         $max = $row['max_budget'];
        
      

  ?>
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h4 class="m-0 font-weight-bold text-primary"><?php echo $title?></h4><br>
    <span style="color:blue;font-weight:bold; ">Due Date: <?php echo $date;?></span>
    
    
  </div>
  <!-- Card Body -->
  <div class="card-body">
    
     <h6 style="color:red;font-weight:bold"><?php echo $desc;?><h6>
     <br>
    
     <h6 style="color:orange;">REF# : <?php echo $id;?><h6>
     <h6 style="color:orange;">MINIMUM BUDGET:R<?php echo $min;?><h6>
     <h6 style="color:orange;">Catergory: <?php echo $catergory; ?>
     <br>
     <p class="m-0 font-weight-bold text-primary"><?php echo $desc2; ?></p><br>

     <button type="submit" class="btn btn-success"  name="save"id="save"><a href="bidding.php?id=<?php echo $id; ?>"> Make Bid</a></button>
     
     
  </div>

  <?php
   }

?>
</div>

         
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; TBS 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
