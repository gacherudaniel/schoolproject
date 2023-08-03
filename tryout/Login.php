<?php
    session_start();
    include_once("includes/config.php");

    // Initialize error messages
    $wrongusername = '';
    $wrongpassword = '';

    // Check if the user is already logged in
    if (isset($_SESSION['userlogin'])) {
        // User is already logged in, redirect based on their role
        if ($_SESSION['role'] === 'contractor') {
            header('location: Contractor_Dashboard.php');
            exit;
        } elseif ($_SESSION['role'] === 'admin') {
            header('location: Admin_Dashboard.php');
            exit;
        }
    }

    // Process the login form if submitted
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $sql = "SELECT name, password, role FROM users WHERE name = :username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $hashpass = $result['password'];
            $role = $result['role'];

            // Verifying Password
            if (password_verify($password, $hashpass)) {
                $_SESSION['userlogin'] = $username;
                $_SESSION['role'] = $role;

                // Redirect based on roles
                if ($role === 'contractor') {
                    // Get the contractor ID and set it in the session
                    $sql_contractor = "SELECT contractor_id FROM contractors WHERE name = :username";
                    $query_contractor = $dbh->prepare($sql_contractor);
                    $query_contractor->bindParam(':username', $username, PDO::PARAM_STR);
                    $query_contractor->execute();
                    $result_contractor = $query_contractor->fetch(PDO::FETCH_ASSOC);
                    if ($result_contractor) {
                        $_SESSION['contractor_id'] = $result_contractor['contractor_id'];
                    }

                    header('location: Contractor_Dashboard.php');
                    exit;
                } elseif ($role === 'admin') {
                    header('location: Admin_Dashboard.php');
                    exit;
                } else {
                    $wrongpassword = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oh Snapp!😕</strong> Alert <b class="alert-link">Role: </b>Unknown user role.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>'; 
                }
            }  elseif ($password === $hashpass) {
                // Update the password to the hashed value
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateSql = "UPDATE users SET password = :password WHERE name = :username";
                $updateQuery = $dbh->prepare($updateSql);
                $updateQuery->bindParam(':password', $hashedPassword);
                $updateQuery->bindParam(':username', $username);
                if ($updateQuery->execute()) {
                    // Password updated successfully
                    $_SESSION['userlogin'] = $username;
                    $_SESSION['role'] = $role;
                    // Redirect based on roles
                    if ($role === 'contractor') {
                        // Get the contractor ID and set it in the session
                        $sql_contractor = "SELECT contractor_id FROM contractors WHERE name = :username";
                        $query_contractor = $dbh->prepare($sql_contractor);
                        $query_contractor->bindParam(':username', $username, PDO::PARAM_STR);
                        $query_contractor->execute();
                        $result_contractor = $query_contractor->fetch(PDO::FETCH_ASSOC);
                        if ($result_contractor) {
                            $_SESSION['contractor_id'] = $result_contractor['contractor_id'];
                        }

                        header('location: Contractor_Dashboard.php');
                        exit;
                    } elseif ($role === 'admin') {
                        header('location: Admin_Dashboard.php');
                        exit;
                } else {
                    $wrongpassword = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oh Snapp!😕</strong> Alert <b class="alert-link">Role: </b>Unknown user role.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>'; 
                }
                } else {
                    // Error updating the password
                    echo "Error updating password.";
                }
            } else {
                $wrongpassword = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oh Snapp!😕</strong> Alert <b class="alert-link">Password: </b>You entered the wrong password.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            $wrongusername = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh Snapp!🙃</strong> Alert <b class="alert-link">UserName: </b> You entered a wrong UserName.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    }
?>

<!-- Rest of your login page code -->


<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="Contractor Management System">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
		
		<title>Login - Contractor Management System</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="account-page">
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
			<div class="account-content">
				<div class="container">
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.php"><img src="assets/img/logo2.png" alt="Company Logo"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">System Login</h3>
							<!-- Account Form -->
							<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label>User Name</label>
									<input class="form-control" name="username" required type="text">
								</div>
								<?php if($wrongusername){echo $wrongusername;}?>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
									</div>
									<input class="form-control" name="password" required type="password">
								</div>
								<?php if($wrongpassword){echo $wrongpassword;}?>
								
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" name="login" type="submit">Login</button>
										<div class="col-auto pt-2">
											<a class="text-muted float-right" href="forgot-password.php">
												Forgot password?
											</a>
										</div>
								</div>
									
								
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
	</body>
</html>