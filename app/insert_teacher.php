<?php
// Database connection
include 'db_connect.php';

// Get form data using $_POST
// $T_ID = $_POST['T_ID'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$qualification = $_POST['qualification'];
$year_of_experience = $_POST['year_of_experience'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$date_of_joining = $_POST['date_of_joining'];
$pay_per_hour = $_POST['pay_per_hour'];

// Insert data into the database
$sql = "INSERT INTO Teachers (first_name, middle_name, last_name, date_of_birth, gender, qualification, year_of_experience, address_street, address_city, address_state, address_zip, contact_number, email, date_of_joining, pay_per_hour) 
        VALUES ('$first_name', '$middle_name', '$last_name', '$date_of_birth', '$gender', '$qualification', '$year_of_experience', '$address_street', '$address_city', '$address_state', '$address_zip', '$contact_number', '$email', '$date_of_joining', '$pay_per_hour')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('New Teacher Added Successfully');
            window.location.href = 'teacher_management.php';
        </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>