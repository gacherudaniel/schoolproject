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
    <style>
      /* Add your custom styles here */
      /* Example styles for the reporting and analytics page */
    
    .container {
      margin: 20px;
    }

    h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .report {
      margin-bottom: 30px;
    }

    .report h3 {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    thead th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    tbody tr:hover {
      background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
</style>

  </style>
</head>

<body>

  <!-- Main Wrapper -->
  <div class="main-wrapper">
		
    <!-- Header -->
        <?php include_once("includes/header.php");?>
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
              <h3 class="page-title">Hi  <?php echo htmlentities(ucfirst($_SESSION['userlogin']));?>!</h3>
              <ul class="breadcrumb">
                <li class="breadcrumb-item active">Reporting and Analytics</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /Page Header -->

        
    <div class="container">
    
      
        <div id="report-container">
          <!-- Report 1: Contractor Performance -->
          <div class="report" id="report-container">
            <h3>Contractor Performance</h3>
            <table>
                <thead>
                  <tr>
                    <th>Contractor's ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Fetch the contractors from the database
                  $query = "SELECT c.contractor_id, c.name, c.email, AVG(cr.rating) AS average_rating 
                        FROM contractors c
                        LEFT JOIN contractor_ratings cr ON c.contractor_id = cr.contractor_id
                        GROUP BY c.contractor_id";
                  $stmt = $dbh->query($query);

                  // Check if there are any contractors
                  if ($stmt->rowCount() > 0) {
                    // Loop through the result set and generate table rows
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $contractorId = $row['contractor_id'];
                      $name = $row['name'];
                      $email = $row['email'];
                      $rating = $row['average_rating'];

                      echo '<tr>';
                      echo '<td>' . $contractorId . '</td>';
                      echo '<td>' . $name . '</td>';
                      echo '<td>' . $email . '</td>';
                      echo '<td>' . number_format($rating, 1) . '</td>'; // Format the rating to one decimal place
                      echo '<td>';
                      
                      echo '</td>';
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan="3">No contractors found</td></tr>';
                  }

                  // Close the statement
                  $stmt = null;
                  ?>
                </tbody>

              </table>
          </div>

          <!-- Report 2: Project Status -->
          <div class="report">
            <h3>Project Status</h3>
            <div class="project-list">
              <table>
                <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>Assigned Contractors ID</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php
                  // Fetch the tasks from the database
                  $query = "SELECT project_id, name, start_date , deadline, contractor_id, status FROM projects";
                  $stmt = $dbh->query($query);

                  // Check if there are any tasks
                  if ($stmt->rowCount() > 0) {
                    // Loop through the result set and generate table rows
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $projectId = $row['project_id'];
                      $Projectname = $row['name'];
                      $Startdate = $row['start_date'];
                      $assignedContractor = $row['contractor_id'];
                      $status = $row['status'];
                      $deadline = $row['deadline'];
                      

                      echo '<tr>';
                      echo '<td>' . $Projectname . '</td>';
                      echo '<td>' . $Startdate . '</td>';
                      echo '<td>' . $assignedContractor . '</td>';
                      echo '<td>' . $status . '</td>';
                      echo '<td>' . $deadline . '</td>';
                      
                      echo '<td>';
                      
                      
                      echo '</td>';
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan="6">No projects found</td></tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Report 3: Resource Allocation -->
          <div class="content container-fluid">
            <h2>Task status</h2>
            <div class="report">
              <table>
                <!-- Table header code -->
                <thead>
                  <tr>
                    <th>Task Name</th>
                    <th>Project ID</th>
                    <th>Assigned Contractor ID</th>
                    <th>Deadline</th>
                    <th>Priority</th>
                    <th>Status</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Fetch the tasks from the database
                  $query = "SELECT task_id, task_name, project_id, contractor_id, deadline, priority, status FROM tasks";
                  $stmt = $dbh->query($query);

                  // Check if there are any tasks
                  if ($stmt->rowCount() > 0) {
                    // Loop through the result set and generate table rows
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $taskId = $row['task_id'];
                      $taskName = $row['task_name'];
                      $projectName = $row['project_id'];
                      $assignedContractor = $row['contractor_id'];
                      $deadline = $row['deadline'];
                      $priority = $row['priority'];
                      $status = $row['status'];

                      echo '<tr>';
                      echo '<td>' . $taskName . '</td>';
                      echo '<td>' . $projectName . '</td>';
                      echo '<td>' . $assignedContractor . '</td>';
                      echo '<td>' . $deadline . '</td>';
                      echo '<td>' . $priority . '</td>';
                      echo '<td>' . $status . '</td>';
                      echo '<td>';
                      
                      
                      echo '</td>';
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan="6">No tasks found</td></tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
       
       </div>
    </div>
  </div>
  <!-- /Main Wrapper -->
<!-- Your HTML code above -->

<!-- javascript links starts here -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/morris/morris.min.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/app.js"></script>

<!-- Add jsPDF Library -->
<script src="tcpdf/jspdf.min.js"></script>
<script>
$(document).ready(function() {
  // Handle the button click event
  $('#generate-pdf').click(function() {
    // Create a new jsPDF instance
    var pdf = new jsPDF();

    // Add content to the PDF
    pdf.text("Reporting and Analytics", 10, 10);
    pdf.fromHTML($('#report-container').html(), 15, 15);

    // Save the PDF
    pdf.save("report.pdf");
  });
});
</script>
</body>
</html>


