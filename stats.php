<?php
include("session.php");
include("connection.php");

$username = $_SESSION['username'];


?>

<?php
	
  $post_at = "";
	$post_at_to_date = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"]["post_at"])) {			
		$post_at = $_POST["search"]["post_at"];
		list($fid,$fim,$fiy) = explode("-",$post_at);
		
		$post_at_todate = date('Y-m-d');
		if(!empty($_POST["search"]["post_at_to_date"])) {
			$post_at_to_date = $_POST["search"]["post_at_to_date"];
			list($tid,$tim,$tiy) = explode("-",$_POST["search"]["post_at_to_date"]);
			$post_at_todate = "$tiy-$tim-$tid";
		}
		
		$queryCondition .= "AND b.bid_date BETWEEN '$fiy-$fim-$fid' AND '" . $post_at_todate . "'";
	}
  $query = " SELECT b.industry FROM user u,bidder b WHERE b.user_id = u.id AND u.username = '$username'";
             
  $rs = mysqli_query($con,$query);
  while($ln = mysqli_fetch_array($rs)) 
  {
    $cat = $ln['industry'];
  }
	$sql = "SELECT u.name,u.surname,u.company,b.bid_date,b.amount,b.status,t.tenderId,t.tender_title,t.short_description from bidder u,bid b,tender t WHERE u.id = b.bidder_id AND t.tenderId = b.tender_no AND b.status = 'Won' " . $queryCondition . " ORDER BY b.bid_date desc";
	$result = mysqli_query($con,$sql);
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

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
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
<h1 class="h3 mb-2 text-gray-800">Reports</h1>
<p class="mb-4">Views all awarded tenders</p>

<!-- DataTales Example -->
<form name="frmSearch" method="post" action="">
	 <p class="search_input">
		<input type="text" placeholder="From Date" id="post_at" name="search[post_at]"  value="<?php echo $post_at; ?>" class="input-control" />
	    <input type="text" placeholder="To Date" id="post_at_to_date" name="search[post_at_to_date]" style="margin-left:10px"  value="<?php echo $post_at_to_date; ?>" class="input-control"  />			 
		<input type="submit" name="go" value="Search" >
    <input type="button" onclick="window.location='stats.php?id=<?php echo $username; ?>'" value="View All" >

	</p>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Awards Reports</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
   
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>TenderId</th>
            <th>Title</th>
            <th>Short Description</th>
            <th>name</th>
            <th>Surname</th>
            <th>Company</th>
            <th>Bid date</th>
            <th>Amount</th>
            <th>Status</th>
            
            
          </tr>
        </thead>
        
        <tbody>
        <?php
          if(!empty($result))	 {
	        	while($row = mysqli_fetch_array($result)) {
            
	      ?>
          <tr>
            <td><?php echo $row['tenderId']; ?></td>
            <td><?php echo $row['tender_title']; ?></td>
            <td><?php echo $row['short_description']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['surname']; ?></td>
            <td><?php echo $row['company']; ?></td>
            <td><?php echo $row['bid_date']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td style="color:green;font-weight:bold;"><?php echo $row['status']; ?></td>
            
          
           <?php
              }
            }else{
           ?> 
           <td>no records</td>
           </tr>
           <?php } ?>
        </tbody>
      </table>
      
      </form>
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
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
$.datepicker.setDefaults({
showOn: "button",
buttonImage: "datepicker.png",
buttonText: "Date Picker",
buttonImageOnly: true,
dateFormat: 'dd-mm-yy'   
});
$(function() {
$("#post_at").datepicker();
$("#post_at_to_date").datepicker();
});
</script>
</body>

</html>
