<?php
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include('includes/config.php');

  // Check if the contractor is logged in
  if (!isset($_SESSION['contractor_id'])) {
      // Redirect to the login page if the contractor is not logged in
      header("Location: login.php");
      exit;
  }


  // Get the contractor ID from the session
  $contractor_id = $_SESSION['contractor_id'];

  // Fetch the average rating for the contractor from the contractor_ratings table
  $query = "SELECT AVG(rating) AS average_rating FROM contractor_ratings WHERE contractor_id = :contractorId";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':contractorId', $contractor_id, PDO::PARAM_INT);
  $stmt->execute();
  $ratingData = $stmt->fetch(PDO::FETCH_ASSOC);
  $average_rating = $ratingData['average_rating'];
?>
<!-- Rest of your code -->

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
  <!-- Include the jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Include the FullCalendar JavaScript library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  
  <!-- Your custom styles -->
  <style>
    .calendar {
      margin-bottom: 30px;
    }
  </style>
  
  <!-- Add the JavaScript code -->
  
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
    .average-rating {
    display: flex;
    align-items: left;
    justify-content: left;
    font-size: 18px;
    color: #555;
    }

    .average-rating p {
        margin-right: 10px;
    }

    .rating-number {
        font-size: 24px;
        color: #ff9800; /* Change the color to your desired rating color */
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
      <!-- Page Header -->
              
            <div class="page-header">
              <div class="row">
                <div class="col-sm-12">
                  <h3 class="page-title">Welcome <?php echo htmlentities(ucfirst($_SESSION['userlogin']));?>!</h3>
                  <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard </li>
                  </ul>


                </div>
              </div>
            </div>
            <?php
             $_SESSION['contractor_id'] = $contractor_id; // Set the contractor_id value in the session

              
              $sql = "SELECT project_id FROM projects WHERE contractor_id = :contractor_id";
              $query = $dbh->prepare($sql);
              $query->bindParam(':contractor_id', $contractor_id, PDO::PARAM_INT);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $totalcount = $query->rowCount();
            ?>


            <div class="row"> 
              <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                  <div class="card dash-widget">
                    <div class="card-body">
                      <span class="dash-widget-icon"><i class="fa fa-rocket"></i></span>
                      <div class="dash-widget-info">
                        <h3><?php echo $totalcount; ?></h3>
                        <span>Projects</span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
										$sql = "SELECT task_id from tasks WHERE contractor_id = :contractor_id";
										$query = $dbh->prepare($sql);
                    $query->bindParam(':contractor_id', $contractor_id, PDO::PARAM_INT);
										$query->execute();
										$results = $query->fetchAll(PDO::FETCH_OBJ);
										$totalcount = $query->rowCount();
									?>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                  <div class="card dash-widget">
                    <div class="card-body">
                      <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                      <div class="dash-widget-info">
                        <h3><?php echo $totalcount; ?></h3>
                        <span>Tasks</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                  <div class="card dash-widget">
                    <div class="card-body">
                      <span class="dash-widget-icon"><i class="fa fa-percent"></i></span>
                      <div class="dash-widget-info">
                        <h3><?php echo number_format($average_rating, 1); ?></h3>
                        <span>Average Rating</span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>


               

                
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
