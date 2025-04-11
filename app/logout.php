<?php
// Start the session
session_start();

// Database connection
require "db_connect.php";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you are storing the user ID in the session when logging in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Update the logout time for the latest login entry for this user
    $logoutTimeStmt = $conn->prepare("UPDATE login_history SET logout_time = NOW() WHERE user_id = ? AND logout_time IS NULL");
    $logoutTimeStmt->bind_param("i", $userId);
    $logoutTimeStmt->execute();
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Logging Out</title>
</head>
<body>
    <h1>Logging out...</h1>
    <script>
        // Redirect to the login page after a short delay
        setTimeout(function () {
            window.location.href = 'login.php';
        }, 2000); // Change the delay time as needed
    </script>
</body>
</html>
