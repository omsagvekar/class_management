<?php
// Include the database connection file
include 'db_connect.php';

// Check if teacher ID is provided in the URL
if(isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    // Prepare a delete statement for Slots table
    $stmt_slots = $conn->prepare("DELETE FROM Slots WHERE Teacher_ID = ?");

    // Bind parameters
    $stmt_slots->bind_param("i", $teacherId);

    // Execute the Slots delete statement
    if($stmt_slots->execute()) {
        // Now, prepare a delete statement for Teachers table
        $stmt_teachers = $conn->prepare("DELETE FROM Teachers WHERE T_ID = ?");

        // Bind parameters
        $stmt_teachers->bind_param("i", $teacherId);

        // Execute the Teachers delete statement
        if($stmt_teachers->execute()) {
            // Redirect back to teacher management page after successful deletion
            header("Location: teacher_management.php");
            exit();
        } else {
            // Error handling
            echo "Error deleting teacher record: " . $conn->error;
        }

        // Close the Teachers statement
        $stmt_teachers->close();
    } else {
        // Error handling
        echo "Error deleting related slots records: " . $conn->error;
    }

    // Close the Slots statement
    $stmt_slots->close();
}

// Close the database connection
$conn->close();
?>
