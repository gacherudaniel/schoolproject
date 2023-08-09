<?php
include_once("includes/config.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $projectName = $_POST['projectName'];
    $contractors = $_POST['contractors'];
    $status = $_POST['status'];
    
    // Insert data into the projects table
    $query = "INSERT INTO projects (name, description, start_date, end_date, manager_id)
              VALUES ('$projectName', '', CURDATE(), '', 0)";
    $result = mysqli_query($dbh, $query);
    
    if ($result) {
        $projectId = mysqli_insert_id($dbh); // Get the ID of the inserted project
        
        // Insert contractor assignments into a separate table (assuming you have a table called contractor_assignments)
        foreach ($contractors as $contractorId) {
            $query = "INSERT INTO contractor_assignments (project_id, contractor_id)
                      VALUES ($projectId, $contractorId)";
            mysqli_query($connection, $query);
        }
        
        // Update project status
        $query = "UPDATE projects SET status = '$status' WHERE id = $projectId";
        mysqli_query($connection, $query);
        
        // Redirect to a success page or perform any other desired action
        header('Location: success.php');
        exit;
    } else {
        // Handle database error
        $errorMessage = mysqli_error($dbh);
        // Display an error message or redirect to an error page
        echo "Error: $errorMessage";
    }
}

// Close the database connection
mysqli_close($dbh);
?>
