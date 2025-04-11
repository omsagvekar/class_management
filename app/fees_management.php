<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassMaster - Fees Management</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f7f7f7;
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

        .dashboard {
            flex: 1; /* Allow the content area to grow */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            padding: 10px;
            /* text-align: left; */
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
        .button-container {
            display: flex;
            justify-content: center;
        }
        .add-fee-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .show-by-form {
            margin-right: 20px; /* Added margin to separate from the dashboard */
            font-size: 18px; /* Increased font size */
        }

        .show-by-form label {
            margin-right: 10px;
        }

        .show-by-form select {
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            margin-block: 10px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="dashboard">
            <div>
                <button class="logout" onclick="location.href='logout.php';"><i class="fa-solid fa-power-off"></i> Logout</button>
            </div>
            <h1>Fees Management</h1>
            <form class="show-by-form" method="get">
                    <label for="standard">Show by: </label>
                    <select id="standard" name="standard" onchange="this.form.submit()">
                        <option value="">All Standards</option>
                        <option value="7" <?php echo isset($_GET['standard']) && $_GET['standard'] == '7' ? 'selected' : ''; ?>>7th</option>
                        <option value="8" <?php echo isset($_GET['standard']) && $_GET['standard'] == '8' ? 'selected' : ''; ?>>8th</option>
                        <option value="9" <?php echo isset($_GET['standard']) && $_GET['standard'] == '9' ? 'selected' : ''; ?>>9th</option>
                        <option value="10" <?php echo isset($_GET['standard']) && $_GET['standard'] == '10' ? 'selected' : ''; ?>>10th</option>
                    </select>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Roll No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Standard</th>
                        <th>Total Fees</th>
                        <th>Balance Fees</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'db_connect.php'; 
                    //Main Query
                    $sql = "SELECT s.*, IFNULL(f.total_fees, 0) AS total_fees, IFNULL(f.balance_fees, 0) AS balance_fees
                            FROM students s
                            LEFT JOIN (
                                SELECT student_id,
                                    SUM(Total_Fees) AS total_fees,
                                    SUM(Paid_Fees) AS paid_fees,
                                    SUM(Total_Fees - Paid_Fees) AS balance_fees
                                FROM fees
                                GROUP BY student_id
                            ) f ON s.student_id = f.student_id";

                    // Check if standard is selected in the "Show by" form
                    //Horizontal Fragementation
                    if (isset($_GET['standard']) && !empty($_GET['standard'])) {
                        // Filter by selected standard
                        $standard = $_GET['standard'];
                        $sql .= " WHERE s.standard = $standard";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["roll_number"]."</td>";
                            echo "<td>".$row["first_name"]."</td>";
                            echo "<td>".$row["last_name"]."</td>";
                            echo "<td>".$row["standard"]."</td>";
                            echo "<td>Rs.".$row["total_fees"]."</td>";
                            echo "<td>Rs.".$row["balance_fees"]."</td>";
                            echo "<td>";
                            echo "<button class='add-fee-button' onclick='addFee(".$row["student_id"].")'>Add Fee</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No students found</td></tr>";
                    }
                    $conn->close();
                    ?>

            </tbody>
        </table>
        </div>
    </div>
    <script>
        function addFee(student_id) {
            window.location.href = 'addFee.php?student_id=' + student_id;
        }
    </script>
</body>
</html>
