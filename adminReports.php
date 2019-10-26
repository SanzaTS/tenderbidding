<?php
include("session.php");
include("connection.php");

$username = $_SESSION['username'];


if(isset($_POST['word']))
{

  $filename="Users Report";


  header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename =".$filename.".doc");
header("Pragma: no-cache");
header("Expires: 0");
   echo "<html>";

echo "<body>";
echo "<table style=\"border:1px solid;\">";

echo" <tr >";
echo "<th style=\"border:1px solid;\">TenderId</th>";
echo "<th style=\"border:1px solid;\">Title </th>";
echo "<th style=\"border:1px solid;\">Short Description At</th>";
echo "<th style=\"border:1px solid;\">Due_date</th>";  
echo "<th style=\"border:1px solid;\">Category</th>"; 

               
echo "</tr>";

$sql = "SELECT tenderId,tender_title,short_description,due_date,category FROM tender";
$results = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($results))
{
  
  
  $id = $row['tenderId'];
  $title = $row['tender_title'];
  $desc = $row['short_description'];
  $date = $row['due_date'];
  $cat = $row['category'];






echo "<tr>";
 echo"<td style=\"border:1px solid;\" >".$id."</td>";
  echo"<td style=\"border:1px solid;\">".$title."</td>";
  echo"<td style=\"border:1px solid;\">". $desc."</td>";
  echo"<td style=\"border:1px solid;\">".$company."</td>";
  echo"<td style=\"border:1px solid;\">".$date."</td>";
  echo"<td style=\"border:1px solid;\">".$cat."</td>";
 
echo "</tr>";


  }

echo "</table>";
echo "<body>";
echo "</html>";
}


if(isset($_POST['excel']))
{

  $filename="Users Report";


  header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename =".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");
   echo "<html>";

echo "<body>";
echo "<table style=\"border:1px solid;\">";

echo" <tr >";
echo "<th style=\"border:1px solid;\">TenderId</th>";
echo "<th style=\"border:1px solid;\">Title </th>";
echo "<th style=\"border:1px solid;\">Short Description At</th>";
echo "<th style=\"border:1px solid;\">Due_date</th>";  
echo "<th style=\"border:1px solid;\">Category</th>"; 
                  
echo "</tr>";

$sql = "SELECT tenderId,tender_title,short_description,due_date,category FROM tender ";
$results = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($results))
{
  
  
  $id = $row['tenderId'];
  $title = $row['tender_title'];
  $desc = $row['short_description'];
  $date = $row['due_date'];
  $cat = $row['category'];




echo "<tr>";
echo"<td style=\"border:1px solid;\" >".$id."</td>";
  echo"<td style=\"border:1px solid;\">".$title."</td>";
  echo"<td style=\"border:1px solid;\">". $desc."</td>";
  echo"<td style=\"border:1px solid;\">".$company."</td>";
  echo"<td style=\"border:1px solid;\">".$date."</td>";
  echo"<td style=\"border:1px solid;\">".$cat."</td>";
echo "</tr>";


  }

echo "</table>";
echo "<body>";
echo "</html>";

}


if(isset($_POST['pdf']))
{

 
  require("fpdf/fpdf.php");

  class PDF extends FPDF

  {
    
    // Page header
    function Header()
    {
      $image1 = "images/tutpng.png";
        // Logo
        $this->Image($image1,10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(100,10, $this->Image($image1,10,6,30),1,1,'C');
        // Line break
        $this->Ln(20);
        $this->Cell(198,10, "BIDDER LIST",1,1,'C');
        $this->Ln();
    }
    
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Bidder List ',0,0,'C');
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }
    
    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',8);
     
    
     
    
    
          
      
      $pdf->Ln();
    
      /*   <th>TenderId</th>
            <th>Title</th>
            <th>Short Description</th>
            <th>Due_date</th>
            <th>Category</th>*/
       
      $pdf->Cell(17,10,'TenderId',1,0);
      $pdf->Cell(25,10,'Title',1,0);
      $pdf->Cell(40,10,'Short Decription',1,0);
      $pdf->Cell(18,10,'Due_Date',1,0);
      $pdf->Cell(30,10,'Catergory',1,0);
     
      $pdf->Ln();
        
                  
      $sql = "SELECT tenderId,tender_title,short_description,due_date,category FROM tender";
      $results = mysqli_query($con,$sql);

      while($row = mysqli_fetch_array($results))
      {
        
        

         $id = $row['tenderId'];
         $title = $row['tender_title'];
         $desc = $row['short_description'];
         $date = $row['due_date'];
         $cat = $row['category'];
        
        
       
       
          $pdf->Cell(17,10,$id,1,0);
          $pdf->Cell(25,10,$title,1,0);
          $pdf->Cell(40,10,$desc,1,0);
          $pdf->Cell(18,10,$date,1,0);
          $pdf->Cell(30,10,$cat,1,0);
         

          
        
        
      
      $pdf->Ln();
          
         
        
       }
      
      
      $filename = "user report.pdf";
    
    $pdf->Output();
    
       
       
       
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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminReports.php">
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
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
 
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
           <?php 

            $bids = "SELECT COUNT(*) as Bids FROM bidding ";
            $results1 = mysqli_query($con,$bids);
            while($row = mysqli_fetch_array($results1))
            {
                 $tot = $row['Bids'];
            }

           ?>
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Number of Bids</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tot; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <?php 
             $tender = "SELECT COUNT(*) as Tenders FROM tender";

             $results2 = mysqli_query($con,$tender);
             while($row1 = mysqli_fetch_array($results2))
             {
                $items = $row1['Tenders'];
             }

          ?>
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Number of Tenders</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $items; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <?php
             $users = "SELECT COUNT(*)  as Users FROM bidder";
             $results3 = mysqli_query($con,$users);
             while($row2 = mysqli_fetch_array($results3))
             {
                 $bidders = $row2['Users'];
             }

          ?>
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bidders Registered</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $bidders; ?></div>
              </div>
              
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <?php 
            $query = "SELECT COUNT(*) as People FROM users ";
            $results4 = mysqli_query($con,$query);

            while($row3 = mysqli_fetch_array($results4))
            { 
                $people = $row3['People'];

            }

          ?>
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">All Users</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $people ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

<div class="row">

  <!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Reports</h1>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
        <br>
        <form class="form-inline" method="post" action="adminReports.php">
              <label>Search By</label>
               <select name="filter">
               <option value="Category">Category</option>
               <option value="Date">Due Date</option>
               
               </select>
               <input class="form-control  form-control-sm ml-3 w-75" type="text" name="query" placeholder="search" aria-lebel = "search">
               <input class="btn btn-success" type="submit" name="search" value="search">

             </form>

        <br>
        <br>

        <br>
<form target="_blank"class="form-inline" method="post" action="adminReports.php">
          <input  style="margin-left:200px;"class="btn btn-success" type="submit" name="pdf" value="pdf">
           <input style="align:right;"class="btn btn-success" type="submit" name="word" value="word">
           <input style="align:right;"class="btn btn-success" type="submit" name="excel" value="excel">
               
    </form>
    <br>
    <br>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tender Reports</h6>
  </div>
  

  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>TenderId</th>
            <th>Title</th>
            <th>Short Description</th>
            <th>Due_date</th>
            <th>Category</th>
            <th>Action</th>

            
            
          </tr>
        </thead>
        
        <tbody>
        <?php
              
              if(isset($_POST['search']))
              {

                $filter = $_POST['filter'];
                $keyword = $_POST['query'];

                $dataless = "No matching record";

                 if($filter == "Category")
                 {
                  $table = "SELECT tenderId,tender_title,short_description,due_date,category FROM tender 
                  WHERE category  LIKE '%$keyword%'";

                  $output = mysqli_query($con,$table) or die(mysqli_error($con));

                  $rows = mysqli_num_rows($output) ;

                  if($rows > 0 )
                  {
                    while($row =mysqli_fetch_array($output))
                    {
                      $id = $row['tenderId'];
                      $title = $row['tender_title'];
                      $desc = $row['short_description'];
                      $date = $row['due_date'];
                      $cat = $row['category'];

                      ?>

                   <tr>
                     <td><?php echo $id; ?></td>
                     <td><?php echo $title; ?></td>
                     <td><?php echo $desc; ?></td>
                     <td><?php echo $date; ?></td>
                     <td><?php echo $cat; ?></td>
                     <td><button type="submit" class="btn btn-danger"  ><a href="adminBids.php?id=<?php echo $id; ?>"> View bids</a></button></td>

                     </tr>
                    <tr>

                      <?php

                    }
                      
                  }
                  else{

                    //No data found
                    ?>
                     <tr>
                                <td><?php  echo $dataless; ?></td>
                               </tr>

                    <?php

                  }
                 
                 
                }
                else{
                    //Due Date


                    $table = "SELECT tenderId,tender_title,short_description,due_date,category FROM tender 
                  WHERE due_date  LIKE '%$keyword%'";

                  $output = mysqli_query($con,$table) or die(mysqli_error($con));

                  $rows = mysqli_num_rows($output) ;

                  if($rows > 0)
                  { 
                     
                    while($row =mysqli_fetch_array($output))
                    {
                      $id = $row['tenderId'];
                      $title = $row['tender_title'];
                      $desc = $row['short_description'];
                      $date = $row['due_date'];
                      $cat = $row['category'];

                      ?>
                        
                         <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $desc; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $cat; ?></td>
                            <td><button type="submit" class="btn btn-danger"  ><a href="adminBids.php?id=<?php echo $id; ?>"> View bids</a></button></td>

                            </tr>
                         <tr>

                      <?php


                    }

                  }
                  else{
                    //No Data

                    ?>

                                <tr>
                                <td><?php  echo $dataless; ?></td>
                               </tr>

                    <?php
                  }

                }



              }
              else{

                $table = "SELECT tenderId,tender_title,short_description,due_date,category FROM tender  ";
                

              
                $output = mysqli_query($con,$table) or die(mysqli_error($con));
  
                while($row =mysqli_fetch_array($output))
                {
                  $id = $row['tenderId'];
                  $title = $row['tender_title'];
                  $desc = $row['short_description'];
                  $date = $row['due_date'];
                  $cat = $row['category'];


                ?>
                     <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $desc; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $cat; ?></td>
            <td><button type="submit" class="btn btn-danger"  ><a href="adminBids.php?id=<?php echo $id; ?>"> View bids</a></button></td>
            
           
           
            
          </tr>
          <tr>

                <?php

              }
            }
           ?>
          <tr>
          
        </tbody>
      </table>
    </div>
  </div>
</div>

 


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
