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
  <title>Contractor Profile</title>
  
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
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
  <!-- Custom CSS -->
  <style>
    /* Add your custom styles here */
    /* Example styles for the contractor profile */
    .profile-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .profile-header img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .profile-section {
      margin-bottom: 20px;
    }

    .profile-section h3 {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
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
  
                <div class="profile-header">
                  <img src="profile-picture.jpg" alt="Profile Picture">
                  <h2>John Doe</h2>
                  <h4>IT Contractor</h4>
                </div>

                <div class="profile-section">
                  <h3>Personal Information</h3>
                  <p>Full Name: John Doe</p>
                  <p>Date of Birth: January 1, 1990</p>
                  <!-- Add more personal information fields as needed -->
                </div>

                <div class="profile-section">
                  <h3>Skills and Certifications</h3>
                  <ul>
                    <li>Java</li>
                    <li>JavaScript</li>
                    <li>HTML/CSS</li>
                    <!-- Add more skills and certifications as needed -->
                  </ul>
                </div>

                <div class="profile-section">
                  <h3>Work Experience</h3>
                  <ul>
                    <li>
                      <strong>Company A</strong> - Software Engineer (2015 - 2020)<br>
                      Responsibilities: Developed web applications using Java and Spring framework.
                    </li>
                    <li>
                      <strong>Company B</strong> - Frontend Developer (2013 - 2015)<br>
                      Responsibilities: Built responsive user interfaces using HTML, CSS, and JavaScript.
                    </li>
                    <!-- Add more work experience entries as needed -->
                  </ul>
                </div>

                <div class="profile-section">
                  <h3>Education and Qualifications</h3>
                  <p>Bachelor's Degree in Computer Science - University XYZ (2012)</p>
                  <p>Java Certification - ABC Institute (2013)</p>
                  <!-- Add more education and qualification details as needed -->
                </div>

                <div class="profile-section">
                  <h3>Project History</h3>
                  <ul>
                    <li>
                      Project A - Full-stack Web Development (2020)<br>
                      Role: Lead Developer<br>
                      Description: Developed and deployed a scalable web application using Node.js and React.
                    </li>
                    <li>
                      Project B - Mobile App Development (2018)<br>
                      Role: Frontend Developer<br>
                      Description: Created a cross-platform mobile app using React Native.
                    </li>
                    <!-- Add more project history entries as needed -->
                  </ul>
                </div>

              <div class="profile-section">
                <h3>Contact and Communication</h3>
                <p>Email: john.doe@example.com</p>
                <p>Phone: +1 123-456-7890</p>
                <!-- Add more contact details as needed -->
              </div>

    <!-- Add more sections or customize the existing sections as per your requirements -->

  </div>

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