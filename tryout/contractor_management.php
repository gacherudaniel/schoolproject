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
  <title>Admin Dashboard - Contractor Management</title>

  <!-- Add your CSS stylesheets here -->
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

  <style>
    /* Add your custom styles here */
    .container {
      margin-top: 20px;
    }

    .section-header {
      margin-bottom: 30px;
    }

    .contractor-list {
      margin-bottom: 30px;
    }

    .contractor-list table {
      width: 100%;
      border-collapse: collapse;
    }

    .contractor-list th,
    .contractor-list td {
      padding: 8px;
      border: 1px solid #ccc;
    }

    .contractor-list th {
      background-color: #f0f0f0;
    }

    .add-contractor-form {
      margin-bottom: 30px;
    }

    .add-contractor-form input[type="text"],
    .add-contractor-form input[type="email"],
    .add-contractor-form input[type="password"] {
      margin-bottom: 10px;
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
    
                <div class="section-header">
                <h2>Contractor Management</h2>
                </div>

                <div class="contractor-list">
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Fetch and display the contractor data dynamically from the database -->
                    <!-- Each row represents a contractor -->
                    <tr>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                        <td>
                        <!-- Include appropriate actions for deleting contractors -->
                        <button>Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>
                        <button>Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows for other contractors -->
                    </tbody>
                </table>
                </div>

                <div class="add-contractor-form">
                <h3>Add Contractor</h3>
                <form>
                    <div>
                    <label for="contractorName">Name:</label>
                    <input type="text" id="contractorName" name="contractorName" required>
                    </div>
                    <div>
                    <label for="contractorEmail">Email:</label>
                    <input type="email" id="contractorEmail" name="contractorEmail" required>
                    </div>
                    <div>
                    <label for="contractorPassword">Password:</label>
                    <input type="password" id="contractorPassword" name="contractorPassword" required>
                    </div>
                    <button type="submit">Add Contractor</button>
                </form>
                </div>
                
  </div>

  <!-- Add your JavaScript code here -->
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
