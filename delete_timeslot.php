<?php
session_start();
include 'connect.php'; 
include 'header.php';

if (!isset($_SESSION['instructor_id'])) {
    header("Location: login.php"); 
 }

if (isset($_GET['id'])) {
    $id = $_GET['id']; 

    
    if (is_numeric($id)) {
        
        $sql = "DELETE FROM instructor_availability WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo "Time slot deleted successfully.";
            header("Location: instructor_dashboard.php"); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn); 
        }
    } else {
        echo "Invalid time slot ID.";
    }
} else {
    echo "Invalid request.";
}
include 'footer.php';
?>
