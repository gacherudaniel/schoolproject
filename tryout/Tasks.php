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
    <style>

      .project-card {
          border: 1px solid #ccc;
          padding: 20px;
          margin-bottom: 20px;
        }
      .task-list {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .task-item {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
      }

      .task-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
      }

      .project-description {
        font-size: 16px;
        color: #444;
      }

      .task-deadline {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
      }

      .project-status {
        font-size: 14px;
        font-weight: bold;
        color: #007bff;
      }

      .status-form {
        display: inline-block;
        margin-top: 10px;
      }

      .status-label {
        font-size: 14px;
        color: #444;
        margin-right: 5px;
      }

      .status-button {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
      }

      .status-button:hover {
        background-color: #0056b3;
      }
    </style>
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
              $contractorId = $_SESSION['contractor_id'];

              try {
                // Fetch the project data from the database
                $query = "SELECT * FROM tasks WHERE contractor_id = :contractorId";
                $result = $dbh->prepare($query);
                $result->bindParam(':contractorId', $contractorId, PDO::PARAM_INT);
                $result->execute();
                // Check if there are any projects
                if ($result->rowCount() > 0) {
                  // Loop through the project data and generate the HTML cards
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  
                    $projectId = $row['project_id'];
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
                    
                    // Add the checkbox and form to update project status
                    echo '<form action="update_task_status.php" method="post" class="status-form">';
                    echo '<input type="hidden" name="task_id" value="' . $taskId . '">';
                    echo '<label class="status-label" for="status_checkbox">Mark as Completed</label>';
                    echo '<input type="checkbox" name="status_checkbox" id="status_checkbox" value="Completed">';
                    echo '<button type="submit" class="status-button">Update Status</button>';
                    echo '</form>';

                    echo '</li>';
                  }
                  echo '</ul>';
                } else {
                  echo '<p>No tasks found.</p>';
                }

              }
            
                catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
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
