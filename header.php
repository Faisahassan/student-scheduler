<?php
    session_start(); // Start the session on every page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 

    
    <link rel="stylesheet" href="instructor_styles.css"> 
</head>
<body>


<header>
    <div class="logo">
        <img src="logo.png" style="width: 80px; height: auto;">
    </div>

    <nav>
        <a href="instructor_dashboard.php">View Bookings</a>
        <a href="schedule_appointment.php">Schedule Appointments</a>
        <a href="add_timeslot.php">Setup Appointments</a>
        <a href="logout.php">Log Out</a>
    </nav>
</header>

