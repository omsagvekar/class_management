<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Fee Details</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f7f7f7;
        }
        /* .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        } */

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
        }
        th, td {
            padding: 10px;
            text-align: left;
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
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>

        <div class="dashboard">
            <h1>Student Fee Details</h1>

        <?php
        // Include database connection
        include 'db_connect.php';

        // Check if roll number parameter is set
        if(isset($_GET['roll_no'])) {
            $roll_no = $_GET['roll_no'];

            // Fetch fee details based on the roll number
            $sql = "SELECT * FROM fees WHERE student_id = $roll_no";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display fee details in a table
                echo "<table>
                        <tr>
                            <th>Total Fees</th>
                            <th>Paid Fees</th>
                            <th>Balance Fees</th>
                        </tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["Total_Fees"]."</td>";
                    echo "<td>".$row["Paid_Fees"]."</td>";
                    echo "<td>".$row["Balance_Fees"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No fee details found for this student.";
            }
        } else {
            // Redirect if roll number parameter is not set
            header("Location: fees_management.php");
            exit();
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
    </div>
</body>
</html>
