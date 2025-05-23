<?php
include 'db_connect.php'; 

$student_id = $_GET['student_id'];
$sql = "SELECT s.*, f.Last_Payment_Date, f.Total_Fees, SUM(f.Paid_Fees) AS total_paid, MAX(f.Last_Payment_Date) AS last_payment_date
        FROM students s
        LEFT JOIN Fees f ON s.student_id = f.student_id
        WHERE s.student_id = $student_id";  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $roll_number = $row['roll_number']; // Updated column name
    $first_name = $row['first_name']; // Updated column name
    $last_name = $row['last_name']; // Updated column name
    $standard = $row['standard']; // Updated column name
    $last_payment_date = $row['Last_Payment_Date'];
    $total_fees = $row['Total_Fees'];
    $total_paid = $row['total_paid'];
    $balance_fees = $total_fees - $total_paid;
} else {
    // Handle case where student not found
    echo "Student not found.";
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Fees</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .container {
            display: flex; 
            max-width: 1400px; 
            margin: auto;
        }

        .sidebar {
            width: 270px;
            background-color: #007bff;
            color: #fff;
            padding: 20px 10px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        h2 {
            display: block;
            font-size: 1.5em;
            margin-block-start: -0.17em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .dashboard {
            flex: 1; /* Allow the content area to grow */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
    <script>
        function submitForm() {
            // Display a popup
            alert("Fees Information Updated");
            // Reload the page
            location.reload();
        }

        function updateBalance() {
            // Get the total fees and total paid
            var totalFees = parseFloat(<?php echo $total_fees; ?>);
            var totalPaid = parseFloat(<?php echo $total_paid; ?>);

            // Get the paying fees entered by the user
            var payingFees = parseFloat(document.getElementById("paid_fees").value);

            // Calculate the balance fees
            var balanceFees = totalFees - totalPaid - payingFees;

            // Update the balance fees field
            document.getElementById("balance_fees_input").value = "Rs. " + balanceFees.toFixed(2);
        }
    </script>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="dashboard">
        <h1>Add Fees for <?php echo isset($first_name) && isset($last_name) ? $first_name . ' ' . $last_name : 'Student'; ?></h1>
        <!-- Display Fees Information -->
        <table>
            <tr>
                <th>Total Fees</th>
                <th>Total Fees Paid</th>
                <th>Balance Fees</th>
                <th>Last Payment Date</th>
            </tr>
            <tr>
                <td><?php echo isset($total_fees) ? 'Rs. ' . $total_fees : 'Rs. 0'; ?></td>
                <td><?php echo isset($total_paid) ? 'Rs. ' . $total_paid : 'Rs. 0'; ?></td>
                <td id="balance_fees"><?php echo isset($balance_fees) ? 'Rs. ' . $balance_fees : 'Rs. 0'; ?></td>
                <td><?php echo isset($last_payment_date) ? $last_payment_date : '-'; ?></td>
            </tr>
        </table>
        <!-- Form to Add Fees -->
        <form action="saveFees.php" method="post">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <?php if (!isset($total_fees)): ?>
            <!-- Only show total fees input if total fees is not set -->
            <label for="total_fees">Total Fees:</label>
            <input type="text" id="total_fees" name="total_fees" required><br><br>
            <?php else: ?>
            <!-- Show total fees as readonly if already set -->
            <label for="total_fees">Total Fees:</label>
            <input type="text" id="total_fees" name="total_fees" value="<?php echo $total_fees; ?>" readonly><br><br>
            <?php endif; ?>
            <label for="paid_fees">Paying Fees:</label>
            <input type="text" id="paid_fees" name="paid_fees" oninput="updateBalance()" required><br><br>
            <label for="balance_fees">Balance Fees:</label>
            <input type="text" id="balance_fees_input" name="balance_fees" value="<?php echo $balance_fees; ?>" readonly><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>
