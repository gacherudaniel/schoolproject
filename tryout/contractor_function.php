<?php
include_once("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Prepare SQL statements
    $contractorSql = "INSERT INTO contractors (name, email, password, status) 
            VALUES (:name, :email, :password, :status)";
    $userSql = "INSERT INTO users (name, email, password, role) 
            VALUES (:name, :email, :password, 'contractor')";

    // Begin transaction
    $dbh->beginTransaction();

    try {
        // Insert into contractors table
        $contractorQuery = $dbh->prepare($contractorSql);
        $contractorQuery->bindParam(':name', $name);
        $contractorQuery->bindParam(':email', $email);
        $contractorQuery->bindParam(':password', $password);
        $contractorQuery->bindParam(':status', $status);
        $contractorQuery->execute();

        // Insert into users table
        $userQuery = $dbh->prepare($userSql);
        $userQuery->bindParam(':name', $name);
        $userQuery->bindParam(':email', $email);
        $userQuery->bindParam(':password', $password);
        $userQuery->execute();

        // Commit the transaction
        $dbh->commit();

        echo "<script>alert('New record created successfully');</script>";
        header("Location: contractor_management.php");
        exit;
    } catch (PDOException $e) {
        // Rollback the transaction in case of error
        $dbh->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$dbh = null;

?>
