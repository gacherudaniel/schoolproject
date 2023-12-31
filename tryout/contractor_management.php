<?php
  session_start();
  error_reporting(0);
  include('includes/config.php');

  // Delete contractor functionality
  if (isset($_GET['delete'])) {
    $taskId = $_GET['delete'];

    // Delete the task from the database
    $query = "DELETE FROM contractors WHERE contractor_id = :contractorId";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':contractorId', $contractorId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect to the current page after deleting the task
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $contractorId = $_POST['contractorId'];
    $rating = $_POST['rating'];

    // Validate the input if needed (e.g., check if the admin has already rated this contractor)

    try {
        // Insert the rating data into the contractor_ratings table
        $query = "INSERT INTO contractor_ratings (contractor_id, rating) 
                  VALUES (:contractorId, :rating)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':contractorId', $contractorId, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect to the contractor listing page or perform any other desired action
        echo "<script>alert('Rating submitted successfully');</script>";
        header("Location: contractor_management.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  // Fetch the list of contractors from the database
  $query = "SELECT contractor_id, name FROM contractors";
  $stmt = $dbh->query($query);
  $contractors = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

  <!-- Custom CSS -->
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
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .add-contractor-form button {
      padding: 10px 20px;
      background-color: #337ab7;
      border: none;
      color: #fff;
      cursor: pointer;
    }

    .add-contractor-form button:hover {
      background-color: #286090;
    }
    .container {
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

        <div class="section-header">
          <h2>Contractor Management</h2>
        </div>

        <div class="contractor-list">
          <table>
            <thead>
              <tr>
                <th>Contractor's ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch the contractors from the database
              $query = "SELECT contractor_id, name, email FROM contractors";
              $stmt = $dbh->query($query);

              // Check if there are any contractors
              if ($stmt->rowCount() > 0) {
                // Loop through the result set and generate table rows
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $contractorId = $row['contractor_id'];
                  $name = $row['name'];
                  $email = $row['email'];

                  echo '<tr>';
                  echo '<td>' . $contractorId . '</td>';
                  echo '<td>' . $name . '</td>';
                  echo '<td>' . $email . '</td>';
                  echo '<td>';
                  echo '<a class="btn btn-danger btn-sm" href="?delete=' . $contractorId . '">Delete</a>';
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

        <div class="add-contractor-form">
          <h3>Add Contractor</h3>
          <form method="POST" action="contractor_function.php">
          <div>
              <label for="contractor_id">Contractor Id:</label>
              <input type="number" id="contractor_id" name="contractor_id" required>
            </div>
            <div>
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div>
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div>
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" required>
            </div>
            <div>
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                  <option value="active">active</option>
                  <option value="inactive">inactive</option>
                </select>
              </div>
            </div>

            <button type="submit">Add Contractor</button>
          </form>
        </div>
        <div class="container">
          <h2>Rate Contractor</h2>
          <form method="POST">
              <div class="form-group">
                  <label for="contractorId">Select Contractor:</label>
                  <select name="contractorId" id="contractorId">
                      <!-- Populate the contractor options from the database -->
                      <?php foreach ($contractors as $contractor) : ?>
                          <?php $contractorId = $contractor['contractor_id']; ?>
                          <?php $contractorName = $contractor['name']; ?>
                          <option value="<?php echo $contractorId; ?>"><?php echo $contractorName; ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
              <div class="form-group">
                  <label for="rating">Rating:</label>
                  <select name="rating" id="rating">
                      <option value="1">1 - Poor</option>
                      <option value="2">2 - Fair</option>
                      <option value="3">3 - Good</option>
                      <option value="4">4 - Very Good</option>
                      <option value="5">5 - Excellent</option>
                  </select>
              </div>
              <div class="form-group">
                  <input type="submit" value="Submit Rating">
              </div>
          </form>
        </div>
    </div>

      </div>

      <!-- Add your JavaScript code here -->
    </div>
    <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->

  <!-- JavaScript links -->
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
