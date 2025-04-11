<?php
// Include the database connection file
include 'db_connect.php';

// Check if the teacher ID is set
if (isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    // Query to fetch teacher data
    $query = "SELECT * FROM Teachers WHERE T_ID = $teacherId";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch teacher data as an associative array
        $teacherData = $result->fetch_assoc();
        // Convert the data to JSON format and output it
        echo json_encode($teacherData);
    } else {
        // If no teacher found, return an empty object
        echo json_encode((object)[]);
    }
} else {
    // If teacher ID is not provided, return an empty object
    echo json_encode((object)[]);
}

// Close the database connection
$conn->close();
?>
