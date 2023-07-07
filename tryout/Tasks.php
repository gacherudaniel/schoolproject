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
  <title>Tasks - Contractor Dashboard</title>

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
</head>

<body>

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
        <div class="container">
          <h2>Tasks</h2>

          <div class="task-list">
            <div class="task-card">
            <?php
              // Assuming you have established a valid PDO database connection

              // Fetch the project data from the database
              $query = "SELECT * FROM tasks";
              $result = $dbh->query($query);

              // Check if there are any projects
              if ($result->rowCount() > 0) {
                // Loop through the project data and generate the HTML cards
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  $task_name = $row['task_name'];
                  $project_name = $row['project_name']; 
                  $description = $row['description'];
                  $deadline = $row['deadline'];
                  $priority = $row['priority'];
                  

                  echo '<div class="project-card">';
                  echo "<h3>$task_name</h3>";
                  echo "<p>Project: $project_name</p>";
                  echo "<p>Description: $description</p>";
                  echo "<p>Deadline: $deadline</p>";
                  echo "<p>Priority: $priority</p>";
                  
                  echo '<button class="btn btn-primary">Mark as Complete</button>';
                  echo '<button class="btn btn-secondary">Request Extension</button>';
                  echo '</div>';
                }
              } else {
                echo '<p>No projects found.</p>';
              }
            ?>
            </div>

          </div>
        </div>

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

</html>
