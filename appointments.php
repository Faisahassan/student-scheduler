<?php
session_start();

// Check if the user is logged in and is an instructor/admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header("Location: login.php");
    exit();
}

// For demonstration purposes, let's simulate fetching appointment data from the database
$appointments = [
    [
        'appointment_id' => 1,
        'student_name' => 'Alice Smith',
        'project_name' => 'Project Alpha',
        'date' => '2025-05-10',
        'time_start' => '10:00',
        'time_end' => '10:20'
    ],
    [
        'appointment_id' => 2,
        'student_name' => 'Bob Johnson',
        'project_name' => 'Project Beta',
        'date' => '2025-05-10',
        'time_start' => '10:20',
        'time_end' => '10:40'
    ],
    // ... more appointment data
];

$instructorName = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 80%; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { background-color: #333; color: #fff; padding: 10px; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #fff; text-decoration: none; margin-left: 15px; }
        .logout-link { color: #f44336; }
    </style>
</head>
<body>
    <div class="header">
        <div>Instructor: <?php echo htmlspecialchars($instructorName); ?></div>
        <nav>
            <a href="#">Dashboard</a>
            <a href="logout.php" class="logout-link">Logoff</a>
        </nav>
    </div>

    <div class="container">
        <h2>Student Appointments</h2>
        <?php if (empty($appointments)): ?>
            <p>No appointments booked yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Student Name</th>
                        <th>Project Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['appointment_id']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['project_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['time_start']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['time_end']); ?></td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>