<?php
// Start the session
session_start();

// Database connection
require "db_connect.php";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$username = $_POST['u'];
$password = $_POST['p'];

// SQL to check username and password
$sql = "SELECT * FROM login_user WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();
    $userId = $user['id']; // Get the user_id from the fetched row

    // Store user_id in the session
    $_SESSION['user_id'] = $userId;
    
    // Insert login time into login_history
    $loginTimeStmt = $conn->prepare("INSERT INTO login_history (user_id, login_time) VALUES (?, NOW())");
    $loginTimeStmt->bind_param("i", $userId);
    $loginTimeStmt->execute();
    
    // Redirect to dashboard
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
