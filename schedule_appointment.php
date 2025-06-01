<?php
session_start();
include 'connect.php';
include 'header.php';



if (!isset($_SESSION['instructor_id'])) {
    header("Location: login.php"); 
    exit();
}

$instructor_id = $_SESSION['Id'];; 

// Fetch all available time slots for the instructor
$sql = "SELECT * FROM instructor_availability WHERE instructor_id = $instructor_id AND booked_appointments = 0"; // Filter for unbooked slots
$time_slots_result = mysqli_query($conn, $sql);

// Fetch all students (those with the role 'student')
$sql_students = "SELECT * FROM users WHERE user_role = 'student'";
$students_result = mysqli_query($conn, $sql_students);

// Handle form submission for scheduling an appointment
$success_message = ''; // Initialize success message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging - check if POST data is being received correctly
    var_dump($_POST);

    $students_in_project = mysqli_real_escape_string($conn, $_POST['students_in_project']); // Students in the project
    $time_slot_id = $_POST['time_slot']; // Selected time slot
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']); // Project name

    // Get the time slot details from the instructor_availability table
    $sql_time_slot = "SELECT * FROM instructor_availability WHERE id = $time_slot_id";
    $time_slot_result = mysqli_query($conn, $sql_time_slot);
    $time_slot = mysqli_fetch_assoc($time_slot_result);

    // Combine date and time for the appointment
    $date_time = $time_slot['date'] . ' ' . $time_slot['time_slot'];

    // Insert the appointment into the appointments table
    $sql_insert_appointment = "INSERT INTO appointments (project_name, students_in_project, date_time, instructor_id)
                               VALUES ('$project_name', '$students_in_project', '$date_time', $instructor_id)";

    // Debugging - check if the SQL query is correct
    echo "SQL Insert: " . $sql_insert_appointment . "<br>";

    if (mysqli_query($conn, $sql_insert_appointment)) {
        // Update the time slot as booked
        $sql_update_slot = "UPDATE instructor_availability SET booked_appointments = 1 WHERE id = $time_slot_id";
        mysqli_query($conn, $sql_update_slot);

        // Set success message
        $success_message = "Appointment successfully scheduled!";
    } else {
        echo "Error: " . mysqli_error($conn); // Show error if query fails
    }
}
include 'footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS -->
</head>
<body>

<main>
    <h2>Schedule Appointment</h2>

    <!-- Success Message -->
    <?php if ($success_message != ''): ?>
        <div class="success-message" style="color: green; font-weight: bold;">
            <p><?php echo $success_message; ?></p>
        </div>
    <?php endif; ?>

    <!-- Appointment Scheduling Form -->
    <form method="post" action="">
        <label for="project_name">Project Name:</label>
        <input type="text" name="project_name" required>

        <label for="students_in_project">Students in Project:</label>
        <input type="text" name="students_in_project" required>

        <label for="time_slot">Select Time Slot:</label>
        <select name="time_slot" required>
            <?php while ($row = mysqli_fetch_assoc($time_slots_result)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['time_slot']; ?> - <?php echo $row['date']; ?></option>
            <?php endwhile; ?>
        </select>

        <input type="submit" value="Schedule Appointment">
    </form>
</main>

</body>
</html>
