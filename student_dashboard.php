<?php
session_start(); // Make sure session is started
include 'connect.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Home</title>
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

    <h4 class="mt-4">Current Appointment</h4>
    <?php
    // TODO: Replace with actual DB query to fetch appointments for the student
    echo "<p>No appointments found.</p>";
    ?>

    <a href="schedule.php" class="btn btn-primary mt-2">Schedule New Appointment</a>
    <a href="delete_appointmentS.php" class="btn btn-danger mt-2">Delete Appointment</a>
    <a href="updateS.php?id=1" class="btn btn-warning mt-2">Update Appointment</a> <!-- fake ID -->

    <!-- Log off Link -->
    <a href="loginS.php" class="btn btn-link mt-2">Log Off</a>

    <!-- Footer -->
    <footer class="mt-5 p-3 border-top text-center">
        <p>&copy; <?php echo date("Y"); ?> Student Portal. All rights reserved.</p>
    </footer>
</div>

</body>
</html>
