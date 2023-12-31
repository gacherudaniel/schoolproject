<?php 
  // Start the session and include the database configuration file
  session_start();
  include_once("includes/config.php");

  // Check if the contractor is logged in
  if (!isset($_SESSION['contractor_id'])) {
      // Redirect to the login page or perform other actions
      header("Location: login.php");
      exit;
  }
    
  
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
    
    /* Add your custom styles here */
    /* Example styles for the contractor dashboard */

    .project-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .project-item {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 20px;
      background-color: #f9f9f9;
      border-radius: 5px;
    }

    .project-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .project-description {
      font-size: 16px;
      color: #444;
    }

    .project-deadline {
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
        <!-- /Page Header -->

        <div class="container">
        

          <div class="project-list">
              <?php
                // Get the contractor ID from the session
                $contractorId = $_SESSION['contractor_id'];

                try {
                    // Fetch the project data for the specific contractor from the database
                    $query = "SELECT * FROM projects WHERE contractor_id = :contractorId";
                    $stmt = $dbh->prepare($query);
                    $stmt->bindParam(':contractorId', $contractorId, PDO::PARAM_INT);
                    $stmt->execute();

                    // Check if there are any projects assigned to the contractor
                    if ($stmt->rowCount() > 0) {
                        // Loop through the project data and generate the HTML list
                       
                        
                        // ... Your existing PHP code ...

                        echo '<ul class="project-list">';
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $projectId = $row['project_id'];
                            $projectName = $row['name'];
                            $description = $row['description'];
                            $deadline = $row['deadline'];
                            $status = $row['status'];

                            // Truncate the description to a maximum length (e.g., 100 characters) to create a snippet
                            $maxDescriptionLength = 100;
                            $snippet = strlen($description) > $maxDescriptionLength ? substr($description, 0, $maxDescriptionLength) . '...' : $description;

                            echo '<li class="project-item">';
                            echo "<h3 class='project-title'>$projectName</h3>";
                            echo "<p class='project-description'>$snippet</p>";
                            echo "<p class='project-deadline'>Deadline: $deadline</p>";
                            echo "<p class='project-status'>Status: $status</p>";

                            // Add the checkbox and form to update project status
                            echo '<form action="update_status.php" method="post" class="status-form">';
                            echo '<input type="hidden" name="project_id" value="' . $projectId . '">';
                            echo '<label class="status-label" for="status_checkbox">Mark as Completed</label>';
                            echo '<input type="checkbox" name="status_checkbox" id="status_checkbox" value="Completed">';
                            echo '<button type="submit" class="status-button">Update Status</button>';
                            echo '</form>';

                            echo '</li>';
                        }
                        echo '</ul>';


                        } else {
                          echo '<p>No projects found for this contractor.</p>';
                        }
                    }
                   catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>

              
              

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
