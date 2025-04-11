<?php
$servername = "db"; // Service name of MySQL container in docker-compose
$username = "user"; // Match docker-compose MYSQL_USER
$password = "password"; // Match docker-compose MYSQL_PASSWORD
$database = "new_classroom"; // Match MYSQL_DATABASE

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
