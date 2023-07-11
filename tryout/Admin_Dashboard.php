<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
  <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Chart CSS -->
  <link rel="stylesheet" href="assets/plugins/morris/morris.css">
		
		<!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.min.css">

  <!-- Custom CSS -->
  <style>
    /* Add your custom styles here */
    /* Example styles for the admin dashboard */
    .container {
      margin-top: 20px;
    }

    .dashboard-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .dashboard-header h2 {
      margin-bottom: 10px;
    }

    .menu {
      margin-bottom: 30px;
    }

    .menu ul {
      list-style: none;
      padding: 0;
    }

    .menu li {
      margin-bottom: 10px;
    }

    .menu li a {
      display: block;
      padding: 8px;
      background-color: #f2f2f2;
      color: #333;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>

<body>
 <!-- Main Wrapper -->
 <div class="main-wrapper">
		
    <!-- Header -->
    <?php include_once("includes/header.php"); ?>
    <!-- /Header -->
    
    <!-- Sidebar -->
    <?php include_once("includes/admin_sidebar.php");?>
    <!-- /Sidebar -->
    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
      <!-- Page Content -->
      <div class="content container-fluid">
      
        <!-- Page Header -->
        <div class="page-header">
          <div class="row">
            <div class="col-sm-12">
              <h3 class="page-title">Welcome <?php echo htmlentities(ucfirst($_SESSION['userlogin']));?>!</h3>

            </div>
          </div>
      </div>
        <!-- /Page Header -->
    </div>

  </div>

  <!-- /Main Wrapper -->
		
  <!-- javascript links starts here -->
  <!-- jQuery -->
  <script src="assets/js/jquery-3.2.1.min.js"></script>
  
  <!-- Bootstrap Core JS -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  
  <!-- Slimscroll JS -->
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  
  <!-- Chart JS -->
  <script src="assets/plugins/morris/morris.min.js"></script>
  <script src="assets/plugins/raphael/raphael.min.js"></script>
  <script src="assets/js/chart.js"></script>
  
  <!-- Custom JS -->
  <script src="assets/js/app.js"></script>
  <!-- javascript links ends here  -->
</body>

</html>
