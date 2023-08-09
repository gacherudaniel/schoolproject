<?php
	session_start();
	error_reporting(E_ALL); 
	include_once('includes/config.php');
 
// Delete task functionality
if (isset($_GET['delete'])) {
  $projectId = $_GET['delete'];

  // Delete contractor assignments for the project
  $query = "DELETE FROM contractor_assignments WHERE project_id = :projectId";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
  $stmt->execute();

  // Delete the project from the projects table
  $query = "DELETE FROM projects WHERE project_id = :projectId";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
  $stmt->execute();
  

  // Redirect to the current page after deleting the task
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}
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

  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

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
      border-collapse: collapse;
    }

    .project-list th,
    .project-list td {
      padding: 8px;
      text-align: left;
      border: 1px solid #ccc;
    }

    .project-list th {
      background-color: #f2f2f2;
    }

    .project-list button {
      margin-right: 5px;
    }

    .create-project-form {
      margin-top: 30px;
    }

    .create-project-form .form-group {
      margin-bottom: 15px;
    }

    .create-project-form label {
      font-weight: bold;
    }

    .create-project-form textarea {
      resize: vertical;
    }

    .create-project-form button[type="submit"] {
      margin-top: 10px;
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
    <?php include_once("includes/admin_sidebar.php"); ?>
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
                <th>Start Date</th>
                <th>Assigned Contractors ID</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Actions</th>
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
                  echo '<a class="btn btn-danger btn-sm" href="?delete=' . $projectId . '">Delete</a>';
                  
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

        <div class="create-project-form">
          <h3>Create New Project</h3>
          <form method="POST" action="projects_function.php">
            <div class="form-group">
              <label for="projectName">Project Name</label>
              <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Enter the project name" required>
            </div>

              <div class="form-group">
                <label for="assigned_contractor">Assigned Contractor</label>
                <select class="form-control"name="assigned_contractor" id="assigned_contractor">
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
                  <!-- Add more contractor options as needed -->
                </select>
                <!-- Add a hidden input field to store the selected project ID -->
                <input type="hidden" id="selectedContractorId" name="selectedContractorId">


                <script>
                  // Retrieve the selected project ID and set it as the value of the hidden input field
                  var contractorSelect = document.getElementById('assigned_contractor');
                  var hiddenInput = document.getElementById('selectedContractorId');

                  contractorSelect.addEventListener('change', function() {
                    var selectedContractorId = contractorSelect.value;
                    hiddenInput.value = selectedContractorId;
                  });
                </script>
              </div>


            <div class="form-group">
              <label for="description">Project Description:</label>
              <textarea id="description" name="description" rows="4" cols="150"></textarea>
            </div>

            <div class="form-group">
              <label for="deadline">Deadline</label>
              <input type="date" class="form-control" name="deadline" id="deadline">
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status" required>
                <option value="In Progress">In Progress</option>
                
                <option value="pending">Pending</option>
              </select>
            </div>



            <button type="submit" class="btn btn-primary">Create Project</button>
          </form>
        </div>

      </div>
      <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->

  <!-- JavaScript -->
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
</body>

</html>
