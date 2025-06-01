<?php

// http://students.cs.ndsu.nodak.edu/~keenan.kuntz/Final_Project/login.php

// Initialize the session
session_start();
require "header.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if (!is_null($row["Instructor_id"])) {
        header("Location: instructor_dashboard.php");
        exit();
    } elseif (!is_null($row["Student_id"])) {
        header("Location: student_dashboard.php");
        exit();
    }
}

require_once "connect.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement to fetch relevant IDs
        $sql = "SELECT Account_id, username, User_role, Instructor_id, Student_id FROM Accounts WHERE username = '$username'";
        // Run the query
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["account_id"] = $row["Account_id"];
                $_SESSION["username"] = $username;
                $_SESSION["user_role"] = $row["User_role"];

                // Set Instructor_id and Student_id in the session (can be null)
                $_SESSION["Instructor_id"] = $row["Instructor_id"];
                $_SESSION["Student_id"] = $row["Student_id"];

                // Redirect based on the presence of Instructor_id or Student_id
                if ($row["Instructor_id"] !== null) {
                    header("Location: instructor_dashboard.php");
                    exit();
                } elseif ($row["Student_id"] !== null) {
                    header("Location: student_dashboard.php");
                    exit();
                } else {
                    // Handle cases where neither ID is present (e.g., admin or error)
                    $login_message = "Invalid user role or account configuration.";
                }
            }
        } else{
            // Username not found
            $login_err = "Invalid username or password.";
        }
    }
    // Close connection
    mysqli_close($conn);
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
              <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        if(isset($login_message)){
            echo '<div class="alert alert-danger">' . $login_message . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p></p>
        </form>
    </div>
    </div>
          </div>
        </div>
        </div>
        </div>
        </section>
</body>
</html>