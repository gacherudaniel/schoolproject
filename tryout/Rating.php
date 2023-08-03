<?php
// rate_contractor.php

// Include the database connection file and any other required files
include_once("includes/config.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $contractorId = $_POST['contractorId'];
    $adminId = $_SESSION['admin_id']; // Assuming you have stored the admin ID in the session
    $rating = $_POST['rating'];

    // Validate the input if needed (e.g., check if the admin has already rated this contractor)

    try {
        // Insert the rating data into the contractor_ratings table
        $query = "INSERT INTO contractor_ratings (contractor_id, admin_id, rating) 
                  VALUES (:contractorId, :adminId, :rating)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':contractorId', $contractorId, PDO::PARAM_INT);
        $stmt->bindParam(':adminId', $adminId, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect to the contractor listing page or perform any other desired action
        echo "<script>alert('Rating submitted successfully');</script>";
        header("Location: contractor_listing.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Fetch the list of contractors from the database
$query = "SELECT contractor_id, name FROM contractors";
$stmt = $dbh->query($query);
$contractors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$dbh = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Contractor</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Example styles for the rating form */
        .container {
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Rate Contractor</h2>
        <form method="POST">
            <div class="form-group">
                <label for="contractorId">Select Contractor:</label>
                <select name="contractorId" id="contractorId">
                    <!-- Populate the contractor options from the database -->
                    <?php foreach ($contractors as $contractor) : ?>
                        <?php $contractorId = $contractor['contractor_id']; ?>
                        <?php $contractorName = $contractor['name']; ?>
                        <option value="<?php echo $contractorId; ?>"><?php echo $contractorName; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating">
                    <option value="1">1 - Poor</option>
                    <option value="2">2 - Fair</option>
                    <option value="3">3 - Good</option>
                    <option value="4">4 - Very Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit Rating">
            </div>
        </form>
    </div>
</body>

</html>
