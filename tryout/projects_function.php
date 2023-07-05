<?php
include_once("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $projectName = $_POST['projectName'];
    $contractors = $_POST['contractors'];
    $status = $_POST['status'];

    try {
        // Insert data into the projects table
        $query = "INSERT INTO projects (name, description, start_date, end_date, manager_id)
                  VALUES (:projectName, '', CURDATE(), '', 1)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':projectName', $projectName);
        $stmt->execute();

        $projectId = $dbh->lastInsertId(); // Get the ID of the inserted project

        // Insert contractor assignments into a separate table (assuming you have a table called contractor_assignments)
        $query = "INSERT INTO contractor_assignments (project_id, contractor_id)
                  VALUES (:projectId, :contractorId)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':projectId', $projectId);

        foreach ($contractors as $contractorId) {
            $stmt->bindParam(':contractorId', $contractorId);
            $stmt->execute();
        }

        // Update project status
        $query = "UPDATE projects SET status = :status WHERE id = :projectId";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':projectId', $projectId);
        $stmt->execute();

        // Redirect to a success page or perform any other desired action
        echo "<script>alert('Record Added Successfully');</script>";
    } catch (PDOException $e) {
    
        echo "<script>alert('Record not Added Successfully');</script>";
            header("Location: Project_Management.php");
            exit;
    }
}

// Close the database connection
$dbh = null;
?>
