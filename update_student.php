<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollNumber = $_POST['editRollNumber'];
    $firstName = $_POST['editFirstName'];
    $middleName = $_POST['editMiddleName'];
    $lastName = $_POST['editLastName'];
    $dob = $_POST['editDOB'];
    $gender = $_POST['editGender'];
    $addressStreet = $_POST['editAddressStreet'];
    $addressCity = $_POST['editAddressCity'];
    $addressState = $_POST['editAddressState'];
    $addressZip = $_POST['editAddressZip'];
    $addressLatitude = $_POST['editAddressLatitude'];  // New Field
    $addressLongitude = $_POST['editAddressLongitude']; // New Field
    $contactNumber = $_POST['editContactNumber'];
    $email = $_POST['editEmail'];
    $guardianName = $_POST['editGuardianName'];
    $guardianRelationship = $_POST['editGuardianRelationship'];
    $guardianContactNumber = $_POST['editGuardianContactNumber'];
    $guardianEmail = $_POST['editGuardianEmail'];
    $admissionDate = $_POST['editAdmissionDate'];

    $sql = "UPDATE students 
            SET first_name=?, middle_name=?, last_name=?, date_of_birth=?, gender=?, 
                address_street=?, address_city=?, address_state=?, address_zip=?, 
                address_latitude=?, address_longitude=?, 
                contact_number=?, email=?, guardian_name=?, guardian_relationship=?, 
                guardian_contact_number=?, guardian_email=?, admission_date=? 
            WHERE roll_number=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssss", 
                      $firstName, $middleName, $lastName, $dob, $gender, 
                      $addressStreet, $addressCity, $addressState, $addressZip, 
                      $addressLatitude, $addressLongitude,  // Bind the new fields
                      $contactNumber, $email, $guardianName, $guardianRelationship, 
                      $guardianContactNumber, $guardianEmail, $admissionDate, 
                      $rollNumber);
    
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Student information updated successfully";
    } else {
        echo "Error updating student information";
    }

    $stmt->close();
    $conn->close();
}
?>
