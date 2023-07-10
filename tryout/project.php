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
          <h2>Projects</h2>

          <div class="project-list">
            <?php
            // Assuming you have established a valid PDO database connection

            // Fetch the project data for the specific contractor from the database
            $contractorId = $_SESSION['contractor_id'];
            $query = "SELECT * FROM projects p
                      INNER JOIN contractor_assignments ca ON p.project_id = ca.project_id
                      WHERE ca.contractor_id = :contractorId";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':contractorId', $contractorId, PDO::PARAM_INT);
            $stmt->execute();

            // Check if there are any projects assigned to the contractor
            if ($stmt->rowCount() > 0) {
              // Loop through the project data and generate the HTML cards
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $projectName = $row['name'];
                $description = $row['description'];
                $deadline = $row['end_date'];
                $status = $row['status'];

                echo '<div class="project-card">';
                echo "<h3>$projectName</h3>";
                echo "<p>Description: $description</p>";
                echo "<p>Deadline: $deadline</p>";
                echo "<p>Status: $status</p>";
                echo '<button class="btn btn-primary">View Details</button>';
                echo '</div>';
              }
            } else {
              echo '<p>No projects found.</p>';
            }

            // Close the statement
            $stmt = null;
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
