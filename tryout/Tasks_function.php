<?php
include_once("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $task_name = $_POST['task_name'];
    $selectedProjectId = $_POST['project_name'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $selectedContractorId = $_POST['assigned_contractor'];

    // Check if the selected project ID exists in the projects table
    $query = "SELECT COUNT(*) FROM projects WHERE project_id = :selectedProjectId";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':selectedProjectId', $selectedProjectId);
    $stmt->execute();
    $projectExists = $stmt->fetchColumn();

    if ($projectExists) {
        // Prepare SQL statement
        $sql = "INSERT INTO tasks (task_name, project_id, deadline, priority, assigned_to) 
                VALUES (:task_name, :selectedProjectId, :deadline, :priority, :selectedContractorId)";

        $query = $dbh->prepare($sql);

        // Bind the parameters
        $query->bindParam(':task_name', $task_name);
        $query->bindParam(':selectedProjectId', $selectedProjectId);
        $query->bindParam(':deadline', $deadline);
        $query->bindParam(':priority', $priority);
        $query->bindParam(':selectedContractorId', $selectedContractorId);

        // Execute SQL statement
        if ($query->execute()) {
            echo "<script>alert('New record created successfully');</script>";
            header("Location: Task_Management.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $query->errorInfo();
        }
    } else {
        
        print_r($_POST);

    }
}

// Close the database connection
$dbh = null;

?>
