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
  <title>Projects - Contractor Dashboard</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
  <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  
  <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  
  <!-- Lineawesome CSS -->
      <link rel="stylesheet" href="assets/css/line-awesome.min.css">
  
  <!-- Select2 CSS -->
  <link rel="stylesheet" href="assets/css/select2.min.css">
  
  <!-- Datetimepicker CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
  
  <!-- Summernote CSS -->
  <link rel="stylesheet" href="assets/plugins/summernote/dist/summernote-bs4.css">
  
  <!-- Main CSS -->
      <link rel="stylesheet" href="assets/css/style.css">
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
  <![endif]-->

  <!-- Custom CSS -->
  <style>
    /* Add your custom styles here */
    /* Example styles for the projects page */
    .container {
      margin-top: 20px;
    }

    .project-list {
      margin-bottom: 30px;
    }

    .project-card {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <!-- Main Wrapper -->
  <div class="main-wrapper">
		
    <!-- Header -->
          <?php include_once("includes/header.php");?>
    <!-- /Header -->
    
    <!-- Sidebar -->
          <?php include_once("includes/sidebar.php");?>
    <!-- /Sidebar -->
    
    <!-- Page Wrapper -->
          <div class="page-wrapper">
    
      <!-- Page Content -->
              <div class="content container-fluid">
      
        <!-- Page Header -->
        <div class="page-header">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="page-title">Projects</h3>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Projects</li>
              </ul>
            </div>
            </div>
          </div>
        </div>
        <!-- /Page Header -->
        <div class="container">
          <h2>Projects</h2>

          <div class="project-list">
            <div class="project-card">
              <h3>Project 1</h3>
              <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu ante vitae enim mollis
                feugiat. Aliquam erat volutpat.</p>
              <p>Deadline: July 31, 2023</p>
              <p>Status: In Progress</p>
              <button class="btn btn-primary">View Details</button>
            </div>

            <div class="project-card">
              <h3>Project 2</h3>
              <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu ante vitae enim mollis
                feugiat. Aliquam erat volutpat.</p>
              <p>Deadline: August 15, 2023</p>
              <p>Status: Not Started</p>
              <button class="btn btn-primary">View Details</button>
            </div>

            <div class="project-card">
              <h3>Project 3</h3>
              <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu ante vitae enim mollis
                feugiat. Aliquam erat volutpat.</p>
              <p>Deadline: September 10, 2023</p>
              <p>Status: Completed</p>
              <button class="btn btn-primary">View Details</button>
            </div>
          </div>
        </div>

  <!-- /Page Content -->
			
				
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Summernote JS -->
		<script src="assets/plugins/summernote/dist/summernote-bs4.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
</body>

</html>