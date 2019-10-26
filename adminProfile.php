<?php
include("session.php");
include("connection.php");

$username = $_SESSION['username'];

$error = "";


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
<?php

if(isset($_POST['save'])){
                
                $name = $_POST['name'];
                //$email = $_POST['email'];
                $surname = $_POST['surname'];
                $contact_no = $_POST['contact_no'];
                //$company = $_POST['company']
               // $address = $_POST['address'];
                
               
                
                
                if($name === ''){
                        
                    }else{
                         //SQL statement to enter the items in the database
                         $sql = "UPDATE admin SET name ='$name' WHERE user_id=(SELECT id FROM users WHERE username = '$username')";
                        $res = mysqli_query($con,$sql);
                        
                        if (!$res) {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                       } else {
                          
                            header('Location: adminProfile.php?id='.$username);
                       }
                       header('Location: adminProfile.php?id='.$username);
                        
                    }
                    
                    if($surname === ''){
                        
                    }else{
                        //SQL statement to enter the items in the database
                        $sql = "UPDATE admin SET surname ='$surname' WHERE user_id=(SELECT id FROM users WHERE username = '$username')";
                        $res = mysqli_query($con,$sql);

                        if (!$res) {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                       } else {
                            header('Location: adminProfile.php?id='.$username);
                       }
                       header('Location: adminProfile.php?id='.$username);
                    }
                    
                    if($contact_no === ''){
                        
                    }else{
                        //SQL statement to enter the items in the database
                        $sql = "UPDATE admin SET contact_no ='$contact_no' WHERE user_id=(SELECT id FROM users WHERE username = '$username')";
                        $res = mysqli_query($con,$sql);

                        if (!$res) {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                       } else {
                            header('Location: adminProfile.php?id='.$username);
                       }
                       header('Location: adminProfile.php?id='.$username);
                    }
                    
            }//end of isset
        ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN <sup>(TBS)</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="adminReports.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
       Admin Dashboard
      </div>
          <!-- Divider -->
      <hr class="sidebar-divider"> 
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Actions</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"> Preform Admin Actions:</h6>
            <a class="collapse-item" href="addAdmin.php?id=<?php echo $username; ?>">Add Admin</a>
            <a class="collapse-item" href="admin.php">Add Tenders</a>
            <a class="collapse-item" href="adminChat.php">Send Notification</a>
          </div>
        </div>
      </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>View</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">View and Generate Reports:</h6>
            <a class="collapse-item" href="adminReports.php">Admin Reports</a>
            <a class="collapse-item" href="tenders.php">View Tenders</a>
            <a class="collapse-item" href="users.php">View Users</a>
            <a class="collapse-item" href="stats.php">View Status</a>
            <a class="collapse-item" href="adminMsg.php">View Notifications</a>
          </div>
        </div>
      </li>
 
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
            
            </li>

         

           

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username."[-ADMIN-]" ?></span>
               <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
 <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
 
</div>

  
<!-- Content Row -->
<div class="row">
<div class="col-lg-12">



<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
<!-- Card Header - Dropdown -->
<?php 

$query = " SELECT a.name, a.surname, a.email, a.contact_no FROM admin a ,users u WHERE a.user_id = u.id AND u.username = '$username'";
$res = mysqli_query($con,$query);
$row1 = mysqli_fetch_array($res);

?>
<div class="content">
<div class="container-fluid">
<div class="row">
 <div class="col-md-8">
     <div class="content">                           
         <form method="post" action="" enctype="multipart/form-data" role="form">
             <div class="row">
                 <div class="col-md-5">
                     <div class="form-group">
                         <label>Email </label>
                             <input type="text" class="form-control" disabled placeholder="Email" value="<?php echo $row1['email']?>">
                     </div>
                 </div>
                 <div class="col-md-3">
                     <!--<div class="form-group">
                         <label>Username</label>
                             <input type="text" class="form-control" placeholder="Username" value="michael23">
                     </div> -->
                 </div>
                 <div class="col-md-4">
                 <!-- <div class="form-group">
                         <label for="exampleInputEmail1">Email address</label>
                             <input type="email" class="form-control" placeholder="Email" value="">
                         </div> -->
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>First Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="First Name" value="<?php echo $row1['name'];?>">
                         </div>
                      </div>
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>Surname</label>
                                 <input type="text" name="surname" class="form-control" placeholder="Surname" value="<?php echo $row1['surname'];?>">
                         </div>
                     </div>
                 </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                  <label>Contact Number</label>
                                     <input type="text" class="form-control" name="contact_no"  placeholder="Contact Number" value="<?php echo $row1['contact_no'];?>">
                             </div>
                         </div>
                    </div>
                     <div class="col-md-4">
                     <!-- <div class="form-group">
                              <label>Country</label>
                                   <input type="text" class="form-control" placeholder="Country" value="Andrew">
                             </div> -->
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <!-- <div class="form-group">
                                 <label>About Me</label>
                                 <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                             </div> -->
                         </div>
                     </div>
                     <button type="submit" name="save" class="btn btn-info btn-fill pull-right">Update Profile</button>
          </form>
      </div>            
  </div>       
</div>
</div>

<?php


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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
