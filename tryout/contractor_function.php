<?php
include_once("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Prepare SQL statement
    $sql = "INSERT INTO contractors (name, email, password, status) 
            VALUES (:name, :email, :password, :status)";

    $query = $dbh->prepare($sql);

    // Bind the parameters
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':status', $status);

    // Execute SQL statement
    if ($query->execute()) {
        echo "<script>alert('New record created successfully');</script>";
            header("Location: contractor_management.php");
            exit;

    } else {
        echo "Error: " . $sql . "<br>" . $query->errorInfo();
    }
}

// Close the database connection
$dbh = null;
?>
