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
  <title>Reporting and Analytics - Admin Interface</title>

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
    /* Example styles for the reporting and analytics page */
    .container {
      margin-top: 20px;
    }

    .report {
      margin-bottom: 30px;
    }

    .report h3 {
      margin-bottom: 10px;
    }

    .report table {
      width: 100%;
    }

    .report th,
    .report td {
      padding: 8px;
      text-align: left;
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
              <ul class="breadcrumb">
                <li class="breadcrumb-item active">Project Management</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /Page Header -->

    <div class="container">
      <h2>Reporting and Analytics</h2>

      <!-- Report 1: Contractor Performance -->
      <div class="report">
        <h3>Contractor Performance</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Contractor</th>
              <th>Completed Tasks</th>
              <th>Rating</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display contractor performance data -->
            <tr>
              <td>Contractor 1</td>
              <td>10</td>
              <td>4.5</td>
            </tr>
            <!-- Add more contractor rows as needed -->
          </tbody>
        </table>
      </div>

      <!-- Report 2: Project Status -->
      <div class="report">
        <h3>Project Status</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Project</th>
              <th>Progress</th>
              <th>Deadline</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display project status data -->
            <tr>
              <td>Project A</td>
              <td>60%</td>
              <td>2023-08-15</td>
            </tr>
            <!-- Add more project rows as needed -->
          </tbody>
        </table>
      </div>

      <!-- Report 3: Resource Allocation -->
      <div class="report">
        <h3>Resource Allocation</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Contractor</th>
              <th>Project</th>
              <th>Allocation</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display resource allocation data -->
            <tr>
              <td>Contractor 1</td>
              <td>Project A</td>
              <td>50%</td>
            </tr>
            <!-- Add more allocation rows as needed -->
          </tbody>
        </table>
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
