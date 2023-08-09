<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Delete task functionality
if (isset($_GET['delete'])) {
  $taskId = $_GET['delete'];

  // Delete the task from the database
  $query = "DELETE FROM tasks WHERE task_id = :taskId";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
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

  <!-- Custom CSS -->



  <!-- Custom CSS -->
  <<style>
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

    .create-task-form {
      margin-top: 30px;
      padding: 20px;
      background-color: #f8f9fa;
      border-radius: 4px;
    }

    .create-task-form label {
      font-weight: bold;
    }

    .create-task-form .form-control {
      margin-bottom: 10px;
    }

    .create-task-form button {
      padding: 10px 20px;
      background-color: #337ab7;
      border: none;
      color: #fff;
      cursor: pointer;
    }

    .create-task-form button:hover {
      background-color: #286090;
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
              <h3 class="page-title">Hi  <?php echo htmlentities(ucfirst($_SESSION['userlogin']));?>!</h3>
              <ul class="breadcrumb">
                <li class="breadcrumb-item active">Task Management</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /Page Header -->
        <div class="task-list">
          <table class="task-list table">
            <!-- Table header code -->
            <thead>
              <tr>
                <th>Task Name</th>
                <th>Project ID</th>
                <th>Assigned Contractor ID</th>
                <th>Deadline</th>
                <th>Priority</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch the tasks from the database
              $query = "SELECT task_id, task_name, project_id, contractor_id, deadline, priority FROM tasks";
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

                  echo '<tr>';
                  echo '<td>' . $taskName . '</td>';
                  echo '<td>' . $projectName . '</td>';
                  echo '<td>' . $assignedContractor . '</td>';
                  echo '<td>' . $deadline . '</td>';
                  echo '<td>' . $priority . '</td>';
                  echo '<td>';
                  echo '<a class="btn btn-danger btn-sm" href="?delete=' . $taskId . '">Delete</a>';
                  
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

                <!-- Form for creating a new task -->
                <h3>Create New Task</h3>
                <form method="POST" action="Tasks_function.php" class="create-task-form ">
                  <div class="form-group">
                    <label for="task_name">Task Name</label>
                    <input type="text" class="form-control"  id="task_name" name="task_name" placeholder="Enter the task name">
                  </div>

                  <div class="form-group">
                    <label for="project_name">Project Name</label>
                    <select class="form-control" name="project_name" id="project_name">
                      <?php
                        // Assuming you have established a valid PDO database connection

                        // Fetch the values from the database
                        $query = "SELECT project_id, name FROM projects";
                        $result = $dbh->query($query);

                        // Check if the query was successful
                        if ($result) {
                          // Loop through the result set and generate the options
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $projectId = $row['project_id'];
                            $projectName = $row['name'];
                            echo "<option value=\"$projectId\">$projectName</option>";
                          }
                        } else {
                          // Handle the error if the query fails
                          $errorInfo = $dbh->errorInfo();
                          echo "Error: " . $errorInfo[2];
                        }
                      ?>
                      
                        
                    </select>
                    <!-- Add a hidden input field to store the selected project ID -->
                    <input type="hidden" id="selectedProjectId" name="selectedProjectId">
                    <script>
                      // Retrieve the selected project ID and set it as the value of the hidden input field
                      var projectSelect = document.getElementById('project_name');
                      var hiddenInput = document.getElementById('selectedProjectId');

                      projectSelect.addEventListener('change', function() {
                        var selectedProjectId = projectSelect.value;
                        hiddenInput.value = selectedProjectId;
                      });
                      projectSelect.addEventListener('change', function() {
                        var selectedProjectId = projectSelect.value;
                        hiddenInput.value = selectedProjectId;
                        console.log(selectedProjectId); // Check if the selected project ID is logged
                      });
                    </script>
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
                    <label for="description">Task Description:</label>
                    <textarea id="description" name="description" rows="4" cols="150"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" class="form-control" name="deadline" id="deadline">
                  </div>

                  <div class="form-group">
                    <label for="status">Priority</label>
                    <select class="form-control" name="priority" id="priority">
                      <option value="Low">Low</option>
                      <option value="High">High</option>
                      <option value="Medium">Medium</option>
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
		
		
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		<!-- javascript links ends here  -->
</body>

</html>