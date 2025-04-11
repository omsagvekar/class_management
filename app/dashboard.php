<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassMaster - Dashboard</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px; /* Added margin */
            padding: 20px; /* Added padding */
            background-color: #f7f7f7;
        }

        
        .dashboard {
            display: flex;
            max-width: 1400px; /* Increased max-width */
            margin: auto; /* Centered horizontally */
            background-color: #fff;
            border-radius: 10px; /* Increased border-radius */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increased box shadow */
            overflow: hidden; /* Hide overflow */
        }

        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            margin-bottom: 10px;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .metrics {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .metric {
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #f4f4f4;
        }

        .metric h2 {
            margin-top: 0;
        }

        .metric p {
            font-size: 24px;
            margin: 0;
        }

        .logout {
            position: relative;
            top: -5px;
            right: -900px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s; /* Adding transition */
        }

        .logout:hover {
            background-color: #0056b3;
        }

        /* Adjusting icon alignment */
    </style>
</head>

<body>
    <?php
    // Include the database connection file
    require 'db_connect.php';

    // Query to get the sum of Paid_Fees
    $query_paid_fees = "SELECT SUM(Paid_Fees) AS total_paid_fees FROM Fees";
    $result_paid_fees = $conn->query($query_paid_fees);
    $total_paid_fees = 0;

    if ($result_paid_fees) {
        $row_paid_fees = $result_paid_fees->fetch_assoc();
        $total_paid_fees = $row_paid_fees['total_paid_fees'];
    }

    // Query to get the sum of Balance_Fees
    $query_balance_fees = "SELECT SUM(Balance_Fees) AS total_balance_fees FROM Fees";
    $result_balance_fees = $conn->query($query_balance_fees);
    $total_balance_fees = 0;

    if ($result_balance_fees) {
        $row_balance_fees = $result_balance_fees->fetch_assoc();
        $total_balance_fees = $row_balance_fees['total_balance_fees'];
    }

    // Query to get the total number of students
    $query_total_students = "SELECT COUNT(*) AS total_students FROM students";
    $result_total_students = $conn->query($query_total_students);
    $total_students = 0;

    if ($result_total_students) {
        $row_total_students = $result_total_students->fetch_assoc();
        $total_students = $row_total_students['total_students'];
    }

    // Close the database connection
    $conn->close();
    ?>

    <!-- <button class="logout" onclick="location.href='logout.php';">Logout</button> -->

    <div class="dashboard">
    <?php include 'sidebar.php'; ?>
        <div class="content">
            <div>
                <button class="logout" onclick="location.href='logout.php';"><i class="fa-solid fa-power-off"></i> Logout</button>
            </div>
            <h1>Welcome to ClassMaster</h1>
            <div class="metrics">
                <div class="metric">
                    <h2>Total Fees Collected</h2>
                    <p><?php echo "Rs." . number_format($total_paid_fees, 2); ?></p>
                </div>
                <div class="metric">
                    <h2>Pending Payments</h2>
                    <p><?php echo "Rs." . number_format($total_balance_fees, 2); ?></p>
                </div>
                <div class="metric">
                    <h2>Total No. of Students</h2>
                    <p><?php echo $total_students; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
