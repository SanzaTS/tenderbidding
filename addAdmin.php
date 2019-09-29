<?php
include("session.php");
include("connection.php");

$username = $_SESSION['username'];
$error = " ";

if(isset($_POST['save']))
{

  $sysname = $_POST['username'];
  $name = $_POST['name'];
  $surname =$_POST['username'];
  $id_num = $_POST['id'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  
    $error = "";
  $date = date("Y-m-d");

      // echo $sysname." ".$name."   ".$surname."  ".$id_num."  ".$phone."  ".$email;
      if(!empty($sysname)||!empty($name)|| !empty($surname) || !empty($id_num) || !empty($email) || !empty($phone))
      {
          if(preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{5,20}$/", $sysname))
          {
              if(strlen($name) >= 3 )
              { 
                 if(strlen($surname))
                 {
                    if(strlen($id_num) == 13)
                    {
                       if(is_numeric($id_num))
                       {
                          if(strlen($phone) == 10)
                          { 
                             if(filter_var($email, FILTER_VALIDATE_EMAIL))
                             {
                                  $ckUser = "SELECT * FROM users WHERE username = '$sysname'";
                                  $res1 = mysqli_query($con,$ckUser);
                                  $row = mysqli_num_rows($res1);
                                  if($row == 0)
                                  {
                                      $ckId = "SELECT * FROM admin WHERE id_num = $id_num AND email = '$email'";
                                      $res2 = mysqli_query($con,$ckId);
                                      $row1 = mysqli_num_rows($res2);

                                      if($row == 0)
                                      {
                                            $sql = "INSERT INTO `users`(`username`, `password`, `role`, `createdAt`, `Active`) VALUES('$sysname','password','Admin','$date','offline')";
                                            if(mysqli_query($con,$sql) or die(mysqli_error($con)))
                                            {
                                              $id = mysqli_insert_id($con);
                                        
                                              $sql2 = "INSERT INTO admin(name,surname,id_num,email,contact_no,user_id) VALUE('$name','$surname','$id_num','$email','$phone',$id)";
                                        
                                              if(mysqli_query($con,$sql2))
                                              {
                                                $error = "Successfull inserted";
                                              }
                                        
                                              else{
                                                $error = "Something went wrong durring the insertion";
                                              }
                                            }
                                            else{
                                              $error ="Something went wrong durring the insertion";
                                            }
                                     
                                      }
                                      else
                                      {
                                        $error = "Make sure you email and Id do not exists";
                                      }


                                  }
                                  else
                                  {
                                    $error = "Username Already Exists";
                                  }
                             }
                             else
                             {
                               $error = "Email is not valid";
                             }

                          }
                          else
                          {
                            $error = "Phone number must be 10 digits";
                          }
                       }
                       else
                       {
                         $error="ID Number must be digits";
                       }
                    }
                    else
                    {
                      $error = "Id must be exact 13 digit ";
                    }
                 }
                 else
                 {
                   $error = "Surname must be atlest 3 charecters ";
                 }

              }
              else
              {
                $error = "Name must be atleast 3 charecters";
              }
          }
          else
          {
            $error ="Username must start with a charecter <br> It must be between 5 to 20 charecters";
          }

      }
      else
      {
         $error = "All fields must be filled";
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
                <a class="dropdown-item" href="adminProfile.php">
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
            <h1 class="h3 mb-0 text-gray-800">Add New ADMIN</h1>
            
          </div>
          
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-6 my-auto"> 
          <form role="form" id="formLogin" novalidate="" method="POST" action="addAdmin.php">
                <label><?php echo $error; ?></label>
               
                
              <div class="form-group">
               <label>Useraneme</label>
                <input class="form-control" name="username" id="username" placeholder="username"  maxlength="20" >
              </div>
              <div class="form-group">
               <label>Name</label>
                <input class="form-control" name="name" id="name" placeholder="name"  maxlength="20" >
              </div>
               <div class="form-group">
               <label>Surname</label>
                <input class="form-control" name="surname" id="surname" placeholder="surname" maxlength="25">
              </div>
               <div class="form-group">
               <label>ID Number</label>
                <input class="form-control" name="id" id="id" placeholder="id number" > 
               
              </div>   
              <div class="form-group">
               <label>contact Number</label>
                <input class="form-control" name="phone" id="phone" placeholder="conact number" > 
               
              </div>     
              <div class="form-group">
               <label>email</label>
               <input class="form-control"  maxlength="30" name="email" id="email" placeholder="email" >
              </div>
              
              <div >


              <div>


              <button type="submit" class="btn btn-success"  name="save"id="save">Save </button>
          </form>
          <br>
              </div>
           <div>

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
