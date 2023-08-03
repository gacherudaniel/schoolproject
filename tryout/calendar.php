<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/config.php');

// Fetch project deadlines
$query = "SELECT project_id, name, deadline FROM projects";
$result = $dbh->query($query);

if ($result) {
  $projectDeadlines = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
  $projectDeadlines = [];
}

// Fetch task deadlines
$query = "SELECT task_id, task_name, deadline FROM tasks";
$result = $dbh->query($query);

if ($result) {
  $taskDeadlines = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
  $taskDeadlines = [];
}

$events = [];

// Format project deadlines
foreach ($projectDeadlines as $deadline) {
  $event = [
    'title' => $deadline['name'],
    'start' => $deadline['deadline'],
    'end' => $deadline['deadline'],
    'backgroundColor' => '#ff0000',
    'url' => 'project_details.php?id=' . $deadline['project_id']
  ];

  $events[] = $event;
}

// Format task deadlines
foreach ($taskDeadlines as $deadline) {
  $event = [
    'title' => $deadline['task_name'],
    'start' => $deadline['deadline'],
    'end' => $deadline['deadline'],
    'backgroundColor' => '#00ff00',
    'url' => 'task_details.php?id=' . $deadline['task_id']
  ];

  $events[] = $event;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

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

  <!-- Include the jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Include the FullCalendar CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

  <!-- Include the FullCalendar JavaScript library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

  <!-- Custom CSS -->
  <style>
    .calendar {
      margin-bottom: 30px;
    }

    /* Custom styles for the calendar */
    #calendar-container {
      max-width: 800px;
      margin: 0 auto;
    }

    .fc-toolbar {
      margin-bottom: 15px;
    }

    .fc-toolbar .fc-left,
    .fc-toolbar .fc-center,
    .fc-toolbar .fc-right {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .fc-toolbar h2 {
      margin: 0;
      font-size: 24px;
    }

    .fc-prev-button,
    .fc-next-button,
    .fc-today-button {
      padding: 5px 10px;
      background-color: #337ab7;
      border: none;
      color: #fff;
      cursor: pointer;
    }

    .fc-prev-button:hover,
    .fc-next-button:hover,
    .fc-today-button:hover {
      background-color: #286090;
    }

    .fc-agendaWeek-button,
    .fc-agendaDay-button {
      padding: 5px 10px;
      background-color: #5cb85c;
      border: none;
      color: #fff;
      cursor: pointer;
    }

    .fc-agendaWeek-button:hover,
    .fc-agendaDay-button:hover {
      background-color: #449d44;
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
          <?php include_once("includes/admin_sidebar.php");?>
    <!-- /Sidebar -->
    
    <!-- Page Wrapper -->
        <div class="page-wrapper">
          <!-- Rest of your HTML code -->
          <div class="calendar" id="calendar">
            <h3>Calendar</h3>
            <div id="calendar-container"></div>
          </div>

          <!-- jQuery -->
          <script src="assets/js/jquery-3.6.0.min.js"></script>
        
          <!-- Bootstrap Core JS -->
          <script src="assets/js/popper.min.js"></script>
          <script src="assets/js/bootstrap.min.js"></script>
        
          <!-- Slimscroll JS -->
          <script src="assets/js/jquery.slimscroll.min.js"></script>

          <script>
            $(document).ready(function() {
              $('#calendar-container').fullCalendar({
                // Options and configurations
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                editable: true,
                events: <?php echo json_encode($events); ?>
              });
            });
          </script>
          
          <!-- Custom JS -->
          <script src="assets/js/app.js"></script>
        </div>
        
  </div>
  <!-- /Main Wrapper -->
</body>

</html>