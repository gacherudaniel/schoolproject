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
  <title>Task Management - Admin Interface</title>

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
    /* Example styles for the task management page */
    .container {
      margin-top: 20px;
    }

    .task-list {
      margin-bottom: 30px;
    }

    .task-list table {
      width: 100%;
    }

    .task-list th,
    .task-list td {
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
    


                <h2>Task Management</h2>

                <div class="task-list">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Task Name</th>
                        <th>Project Name</th>
                        <th>Assigned Contractor</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Display a list of tasks with their details -->
                      <tr>
                        <td>Task A</td>
                        <td>Project A</td>
                        <td>Contractor 1</td>
                        <td>2023-07-15</td>
                        <td>In Progress</td>
                        <td>
                          <button class="btn btn-primary btn-sm">Edit</button>
                          <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                      </tr>
                      <!-- Add more task rows as needed -->
                    </tbody>
                  </table>
                </div>

                <!-- Form for creating a new task -->
                <h3>Create New Task</h3>
                <form>
                  <div class="form-group">
                    <label for="taskName">Task Name</label>
                    <input type="text" class="form-control" id="taskName" placeholder="Enter the task name">
                  </div>

                  <div class="form-group">
                    <label for="projectName">Project Name</label>
                    <select class="form-control" id="projectName">
                      <option value="project1">Project A</option>
                      <option value="project2">Project B</option>
                      <!-- Add more project options as needed -->
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="assignedContractor">Assigned Contractor</label>
                    <select class="form-control" id="assignedContractor">
                      <option value="contractor1">Contractor 1</option>
                      <option value="contractor2">Contractor 2</option>
                      <!-- Add more contractor options as needed -->
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" class="form-control" id="deadline">
                  </div>

                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status">
                      <option value="inProgress">In Progress</option>
                      <option value="completed">Completed</option>
                      <option value="pending">Pending</option>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary">Create Task</button>
                </form>
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