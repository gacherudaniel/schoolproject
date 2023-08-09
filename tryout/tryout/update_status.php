<?php
    include('includes/config.php');
    // update_status.php

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the project_id and status_checkbox values from the form submission
        $projectId = $_POST['project_id'];
        $statusCheckboxValue = $_POST['status_checkbox'];

        // Validate and sanitize the input if necessary
        // ... (you can add validation and sanitization as needed)

        // Assuming you have established a valid PDO database connection in includes/config.php
        include_once("includes/config.php");

        try {
            // Update the project status in the projects table
            $query = "UPDATE projects SET status = :status WHERE project_id = :projectId";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':status', $statusCheckboxValue);
            $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the project listing page (you can change the URL as needed)
            echo "<script>
                        alert('Progress Updated Successfully');
                        window.location.href = 'project.php';
                    </script>";
            exit;
        } catch (PDOException $e) {
            // Handle the error if needed
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $dbh = null;
    } else {
        // If the form was not submitted via POST, redirect back to the project listing page
        echo "<script>
                        alert('Progress update was not successful');
                        window.location.href = 'project.php';
                    </script>";
        exit;
    }
?>
