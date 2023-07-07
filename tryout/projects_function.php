<?php
include_once("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $projectName = $_POST['projectName'];
    $contractors = $_POST['contractors'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    try {
        // Insert data into the projects table
        $query = "INSERT INTO projects (name, deadline, status) 
                  VALUES (:projectName, :deadline, :status)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':projectName', $projectName);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        $projectId = $dbh->lastInsertId(); // Get the ID of the inserted project

        // Insert contractor assignments into a separate table (assuming you have a table called project_contractors)
        $query = "INSERT INTO contractor_assignments (project_id, contractor_id) 
                  VALUES (:projectId, :contractorId)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':projectId', $projectId);

        foreach ($contractors as $contractorId) {
            $stmt->bindParam(':contractorId', $contractorId);
            $stmt->execute();
        }

        // Redirect to a success page or perform any other desired action
        echo "<script>alert('Record Added Successfully');</script>";
        header("Location: Project_Management.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$dbh = null;
?>
