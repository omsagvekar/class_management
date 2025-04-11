<?php
include 'db_connect.php';

// Retrieve form data
$student_id = $_POST['student_id'];
$total_fees = $_POST['total_fees'];
$paid_fees = $_POST['paid_fees'];
$payment_date = date('Y-m-d');

// Check if the student ID exists in the Fees table
$existing_data_query = "SELECT * FROM Fees WHERE student_id = $student_id";
$existing_data_result = $conn->query($existing_data_query);

if ($existing_data_result->num_rows > 0) {
    // Student exists in the Fees table, retrieve existing fees data
    $row = $existing_data_result->fetch_assoc();
    $existing_total_fees = $row['Total_Fees'];
    $existing_paid_fees = $row['Paid_Fees'];
    $existing_balance_fees = $row['Balance_Fees'];

    // Update the fees data
    $new_paid_fees = $existing_paid_fees + $paid_fees;
    $new_balance_fees = $existing_total_fees - $new_paid_fees;

    // Update the fees information in the database
    $update_sql = "UPDATE Fees SET Paid_Fees = '$new_paid_fees', Last_Payment = '$paid_fees', Balance_Fees = '$new_balance_fees', Last_Payment_Date = '$payment_date' WHERE student_id = $student_id";

    if ($conn->query($update_sql) === TRUE) {
        // Display success message and redirect
        echo "<script>alert('Fees Information Updated'); window.location.href = 'fees_management.php';</script>";
    } else {
        // Display error message
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Student does not exist in the Fees table, insert a new row
    $insert_sql = "INSERT INTO Fees (Total_Fees, Paid_Fees, Last_Payment, Balance_Fees, Last_Payment_Date, student_id) VALUES ('$total_fees', '$paid_fees', '$paid_fees', '$total_fees', '$payment_date', $student_id)";

    if ($conn->query($insert_sql) === TRUE) {
        // Display success message and redirect
        echo "<script>alert('Fees Information Updated'); window.location.href = 'fees_management.php';</script>";
    } else {
        // Display error message
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
