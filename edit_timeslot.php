<?php
session_start();
include 'connect.php'; // Include database connection
include 'header.php';

// Check if the instructor is logged in
if (!isset($_SESSION['instructor_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

if (isset($_GET['appointment_ID'])) {
    $id = $_GET['appointment_ID']; // Get the appointment ID from the URL

    // Fetch the current appointment details from the database
    $sql = "SELECT * FROM appointments WHERE appointment_ID = $appointment_ID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for updating the appointment
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
        $students_in_project = mysqli_real_escape_string($conn, $_POST['students_in_project']);
        $date_time = mysqli_real_escape_string($conn, $_POST['date_time']); // Format: 'YYYY-MM-DD HH:MM:SS'

        // Update the appointment in the database
        $sql_update = "UPDATE appointments SET project_name = '$project_name', students_in_project = '$students_in_project', date_time = '$date_time' WHERE appointment_ID = $appointment_ID";

        if (mysqli_query($conn, $sql_update)) {
            echo "Appointment updated successfully.";
            header("Location: instructor_dashboard.php"); // Redirect to dashboard after update
            exit();
        } else {
            echo "Error: " . mysqli_error($conn); // Error handling
        }
    }
} else {
    echo "Invalid request. No appointment ID provided."; // Debugging message
}
include 'footer.php';
?>



<main>
    <h2>Edit Appointment</h2>

    <!-- Appointment Edit Form -->
    <form method="post" action="">
        <label for="project_name">Project Name:</label>
        <input type="text" name="project_name" value="<?php echo $row['project_name']; ?>" required>

        <label for="students_in_project">Students in Project:</label>
        <input type="text" name="students_in_project" value="<?php echo $row['students_in_project']; ?>" required>

        <label for="date_time">Date/Time:</label>
        <input type="datetime-local" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_time'])); ?>" required>

        <input type="submit" value="Update Appointment">
    </form>
</main>

