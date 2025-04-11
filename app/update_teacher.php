<?php
// Include the database connection file
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $teacher_id = $_POST['teacher_id'];
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

    // Update teacher data in the database
    $query = "UPDATE Teachers SET 
                first_name = '$first_name', 
                middle_name = '$middle_name', 
                last_name = '$last_name', 
                date_of_birth = '$date_of_birth', 
                gender = '$gender', 
                qualification = '$qualification', 
                year_of_experience = '$year_of_experience', 
                address_street = '$address_street', 
                address_city = '$address_city', 
                address_state = '$address_state', 
                address_zip = '$address_zip', 
                contact_number = '$contact_number', 
                email = '$email', 
                date_of_joining = '$date_of_joining', 
                pay_per_hour = '$pay_per_hour' 
              WHERE T_ID = $teacher_id";

    if ($conn->query($query) === TRUE) {
        // Redirect to teacher management page after successful update
        header("Location: teacher_management.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
