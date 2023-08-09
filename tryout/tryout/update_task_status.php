<?php
    include('includes/config.php');
    // update_status.php

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the project_id and status_checkbox values from the form submission
        $taskId = $_POST['task_id'];
        $statusCheckboxValue = $_POST['status_checkbox'];

        // Validate and sanitize the input if necessary
        // ... (you can add validation and sanitization as needed)

      
        try {
            // Update the project status in the projects table
            $query = "UPDATE tasks SET status = :status WHERE task_id = :taskId";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':status', $statusCheckboxValue);
            $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the project listing page (you can change the URL as needed)
            echo "<script>
                        alert('Progress Updated Successfully');
                        window.location.href = 'Tasks.php';
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
        echo "<script><alert!>progress update was not successfull</script>";
        header("Location: Tasks.php");
        exit;
    }
?>
