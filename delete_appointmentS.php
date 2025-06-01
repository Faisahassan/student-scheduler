<?php
session_start(); // Always start session if you're using $_SESSION
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Appointment</title>
    <!-- Bootstrap CSS (optional if you're using it) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center p-3 border-bottom">
        <img src="images/logo.png" alt="Site Logo" style="height: 60px;">
    </header>

    <!-- Main Content -->
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['student_username']); ?>!</h2>

    <h3>Delete Appointment</h3>

    <?php
    // TODO: Connect to DB and perform deletion based on student ID
    echo "<p class='text-danger'>Appointment deleted (simulated).</p>";
    ?>

    <a href="student_home.php" class="btn btn-secondary mt-2">Back to Home</a>

    <!-- Log off Link -->
    <a href="loginS.php" class="btn btn-link mt-2">Log Off</a>

    <!-- Footer -->
    <footer class="mt-5 p-3 border-top text-center">
        <p>&copy; <?php echo date("Y"); ?> Student Portal. All rights reserved.</p>
    </footer>
</div>

</body>
</html>
