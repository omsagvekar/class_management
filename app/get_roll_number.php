<?php
include 'db_connect.php';

if (isset($_GET['standard'])) {
    $standard = $_GET['standard'];

    // Query to count the number of students for the selected standard
    $sql = "SELECT COUNT(*) AS count FROM students WHERE standard = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $standard);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();

    // Generate the next roll number
    $rollNumber = $count + 1;

    // Return the roll number
    echo $rollNumber;
}

$conn->close();
?>
