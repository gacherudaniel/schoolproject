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
  <title>Contractor Dashboard</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
  <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  
  <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  
  <!-- Lineawesome CSS -->
      <link rel="stylesheet" href="assets/css/line-awesome.min.css">
  
  <!-- Main CSS -->
      <link rel="stylesheet" href="assets/css/style.css">
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
  <![endif]-->
  <style>
    /* Add your custom styles here */
    /* Example styles for the contractor dashboard */
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

    .project-list {
      margin-bottom: 30px;
    }

    .task-list {
      margin-bottom: 30px;
    }

    .calendar {
      margin-bottom: 30px;
    }

    .message-board {
      margin-bottom: 30px;
    }

    .performance {
      margin-bottom: 30px;
    }

    .account-settings {
      margin-bottom: 30px;
    }
  </style>
</head>

<body>
  <!-- Main Wrapper -->
  <div class="main-wrapper">
		
    <!-- Loader -->
    <div id="loader-wrapper">
      <div id="loader">
        <div class="loader-ellips">
          <span class="loader-ellips__dot"></span>
          <span class="loader-ellips__dot"></span>
          <span class="loader-ellips__dot"></span>
          <span class="loader-ellips__dot"></span>
        </div>
      </div>
    </div>
    <!-- /Loader -->
  
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
    
              <div class="dashboard-header">
                <h2>Contractor Dashboard</h2>
                <!-- Display relevant information or metrics about the contractor here -->
                <p>Welcome, John Doe!</p>
                <p>Projects Completed: 10</p>
                <p>Average Rating: 4.5</p>
              </div>
      
              <div class="project-list">
                <h3>Projects</h3>
                <!-- Display a list of projects assigned to the contractor -->
                <ul>
                  <li>Project 1</li>
                  <li>Project 2</li>
                  <li>Project 3</li>
                </ul>
              </div>
      
              <div class="task-list">
                <h3>Tasks</h3>
                <!-- Display a list of tasks assigned to the contractor -->
                <ul>
                  <li>Task 1</li>
                  <li>Task 2</li>
                  <li>Task 3</li>
                </ul>
              </div>
      
              <div class="calendar">
                <h3>Calendar</h3>
                <!-- Display a calendar view to help contractors visualize their schedule -->
                <!-- Calendar implementation goes here -->
              </div>
      
              <div class="message-board">
                <h3>Messages</h3>
                <!-- Display the messaging or chat feature for communication with project managers/clients -->
                <!-- Messaging or chat implementation goes here -->
              </div>
      
              <div class="performance">
                <h3>Performance</h3>
                <!-- Show performance metrics and feedback from clients or project managers -->
                <p>Overall Performance: Excellent</p>
                <p>Client Feedback: "John Doe is a highly skilled and reliable contractor."</p>
              </div>
      
              <div class="account-settings">
                <h3>Account Settings</h3>
                <!-- Allow contractors to manage their account settings -->
                <p>Change Password</p>
                <p>Email Notifications: On</p>
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
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
	
</body>

</html>
