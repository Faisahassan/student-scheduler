<?php
session_start();
include 'connect.php'; // Include database connection
include 'header.php';


//if (!isset($_SESSION['instructor_id'])) {
//     echo "Instructor is not logged in."; // For debugging
 //    exit();
 //}

$instructor_id = $_SESSION['Id']; // Temporarily set a test instructor ID (for testing)
$selected_date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d'); // Default to today's date

// Fetch available time slots for the selected date from the database
$sql = "SELECT * FROM instructor_availability WHERE instructor_id = $instructor_id AND date = '$selected_date'";
$result = mysqli_query($conn, $sql);

// Fetch booked appointments for the selected date
$sql_appointments = "SELECT * FROM appointments WHERE instructor_id = $instructor_id AND date_time LIKE '$selected_date%'";
$result_appointments = mysqli_query($conn, $sql_appointments);
?>

<?php include 'header.php'; ?> <!-- Include header -->

<main>
    <h2>Instructor Dashboard</h2>

    <!-- Date Picker Form -->
    <form method="post" action="">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $selected_date; ?>" required>
        <input type="submit" value="Show Appointments">
    </form>

    <!-- Show Booked Appointments for Selected Date -->
    <h3>Booked Appointments</h3>
    <?php
    if (mysqli_num_rows($result_appointments) > 0) {
        echo "<table><tr><th>Project Name</th><th>Student(s)</th><th>Date/Time</th><th>Actions</th></tr>";
        while ($row = mysqli_fetch_assoc($result_appointments)) {
            echo "<tr><td>" . $row['project_name'] . "</td>
                  <td>" . $row['students_in_project'] . "</td>
                  <td>" . $row['date_time'] . "</td>
                  <td><a href='edit_appointment.php?id=" . $row['id'] . "'>Edit</a> | 
                  <a href='delete_appointment.php?id=" . $row['id'] . "'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No appointments booked for this date.";
    }
    include 'footer.php';
    ?>

    <!-- Set Up Appointments Link -->
    <h3>Setup Appointment</h3>
    <p>To add new time slots for appointments, please go to the <a href="add_timeslot.php">Setup Appointment page</a>.</p>

    <!-- Schedule an Appointment Link -->
    <h3>Schedule an Appointment</h3>
    <p>To schedule an appointment for a student, please go to the <a href="schedule_appointment.php">Schedule Appointment page</a>.</p>

</main>


