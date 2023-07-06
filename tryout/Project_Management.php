<?php
	session_start();
	error_reporting(E_ALL); 
	include_once('includes/config.php');
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Management - Admin Interface</title>

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
    /* Example styles for the project management page */
    .container {
      margin-top: 20px;
    }

    .project-list {
      margin-bottom: 30px;
    }

    .project-list table {
      width: 100%;
    }

    .project-list th,
    .project-list td {
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
              <h3 class="page-title">Welcome</h3>
              <ul class="breadcrumb">
                <li class="breadcrumb-item active">Project Management</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /Page Header -->

    <div class="project-list">
    <table class="table">
      <thead>
        <tr>
          <th>Project Name</th>
          <th>Assigned Contractors</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Fetch the projects from the database
        $query = "SELECT p.name, p.status, GROUP_CONCAT(c.contractor_id SEPARATOR ', ') AS contractor_assignments
                  FROM projects p
                  INNER JOIN contractor_assignments ca ON p.project_id = ca.project_id
                  INNER JOIN contractors c ON ca.contractor_id = c.contractor_id
                  GROUP BY p.project_id";
        $stmt = $dbh->query($query);

        // Check if there are any projects
        if ($stmt->rowCount() > 0) {
          // Loop through the result set and generate table rows
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $projectName = $row['name'];
            $assignedContractors = $row['contractor_assignments'];
            $status = $row['status'];

            echo '<tr>';
            echo '<td>' . $projectName . '</td>';
            echo '<td>' . $assignedContractors . '</td>';
            echo '<td>' . $status . '</td>';
            echo '<td>';
            echo '<button class="btn btn-primary btn-sm">Edit</button>';
            echo '<button class="btn btn-danger btn-sm">Delete</button>';
            echo '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="4">No projects found</td></tr>';
        }

        // Close the statement
        $stmt = null;
        ?>
      </tbody>
    </table>

    </div>

    <!-- Form for creating a new project -->
    <h3>Create New Project</h3>
    <form method="POST" action="projects_function.php">
      <div class="form-group">
        <label for="projectName">Project Name</label>
        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Enter the project name" required>
      </div>

      <div class="form-group">
        <label for="contractors">Assigned Contractors</label>
        <select class="form-control" id="contractors" name="contractors[]" multiple required>
          <?php
            // Assuming you have established a valid PDO database connection

            // Fetch the values from the database
            $query = "SELECT contractor_id, name FROM contractors";
            $result = $dbh->query($query);

            // Check if the query was successful
            if ($result) {
              // Loop through the result set and generate the options
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $contractorId = $row['contractor_id'];
                $contractorName = $row['name'];
                echo "<option value=\"$contractorId\">$contractorName</option>";
              }
            } else {
              // Handle the error if the query fails
              $errorInfo = $dbh->errorInfo();
              echo "Error: " . $errorInfo[2];
            }
          ?>
        </select>



      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
          <option value="inProgress">In Progress</option>
          <option value="completed">Completed</option>
          <option value="pending">Pending</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Create Project</button>
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
