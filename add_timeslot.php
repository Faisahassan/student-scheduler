<?php
session_start();
include 'connection.php';
include 'header.php';


if (!isset($_SESSION['Id']) || $_SESSION['User_role'] !== 'instructor') {
    header("Location: login.php");
    exit();
}

$instructor_id = $_SESSION['Id'];
$success_message = '';
$error_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $time_slot = mysqli_real_escape_string($conn, $_POST['time_slot']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    if (!empty($time_slot) && !empty($date)) {
        $sql = "INSERT INTO instructor_availability (instructor_id, time_slot, booked_appointments, date) 
                VALUES ('$instructor_id', '$time_slot', 0, '$date')";

        if (mysqli_query($conn, $sql)) {
            $success_message = "Setup Appointment was successful!";
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Please fill in both fields!";
    }
}
include 'footer.php';
?>

<main>
    <h2>Add New Time Slot</h2>

    <?php if ($success_message): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="time_slot">Time Slot:</label>
        <input type="text" name="time_slot" required placeholder="e.g. 10:00 AM - 10:30 AM">

        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <input type="submit" value="Add Time Slot">
    </form>
</main>


