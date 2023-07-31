<?php
include_once("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $projectName = $_POST['projectName'];
    $description = $_POST['description'];
    $selectedContractorId = $_POST['assigned_contractor'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    

    try {
        // Insert data into the projects table
        $query = "INSERT INTO projects (name, description, deadline, status, contractor_id) 
                  VALUES (:projectName, :description, :deadline, :status, :selectedContractorId)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':projectName', $projectName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':selectedContractorId', $selectedContractorId);
        $stmt->execute();

        $projectId = $dbh->lastInsertId(); // Get the ID of the inserted project

        // Insert contractor assignments into a separate table (assuming you have a table called project_contractors)
        $query = "INSERT INTO contractor_assignments (project_id, contractor_id) 
                  VALUES (:projectId, :selectedContractorId)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':projectId', $projectId);

        foreach ($selectedContractorId as $contractorId) {
            $stmt->bindParam(':selectedContractorId', $selectedContractorId);
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
