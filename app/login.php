<?php
session_start();
require "db_connect.php";

// Form data
$username = $_POST['u'];
$password = $_POST['p'];

// Prepare SQL statement to avoid SQL injection
$query = "SELECT * FROM login_user WHERE username = ? AND password = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $userId = $user['id'];

    $_SESSION['user_id'] = $userId;

    // Log login time
    $loginTimeStmt = $conn->prepare("INSERT INTO login_history (user_id, login_time) VALUES (?, NOW())");
    $loginTimeStmt->bind_param("i", $userId);
    $loginTimeStmt->execute();

    header("Location: dashboard.php");
    exit;
} else {
    echo "<script>
        alert('Invalid Username or Password!!!');
        window.location.href = 'login.html';
    </script>";
}

$conn->close();
?>
