<?php
// Include the database connection file
include 'db_connect.php';

// Check if student_id is set and not empty
if(isset($_POST['studentId']) && !empty($_POST['studentId'])) {
    // Sanitize the input to prevent SQL injection
    $studentId = $_POST['studentId'];

    // Prepare a delete statement
    $sql = "DELETE FROM students WHERE student_id = ?";

    if($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("i", $studentId);

        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            // Student deleted successfully
            echo "success";
        } else {
            // Error executing the statement
            echo "error";
        }
    } else {
        // Error preparing the statement
        echo "error";
    }

    // Close the statement
    $stmt->close();
} else {
    // If studentId is not set or empty
    echo "error";
}

// Close the database connection
$conn->close();
?>
