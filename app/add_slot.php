<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Slot</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            display: flex;
            max-width: 800px;
            margin: auto;
        }

        .dashboard {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"] {
            width: calc(100% - 22px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="dashboard">
            <h1>Add Slot</h1>
            <?php
            // Include the database connection file
            include 'db_connect.php';

            // Fetch teacher ID from the URL parameter
            if (isset($_GET["teacher_id"]) && !empty(trim($_GET["teacher_id"]))) {
                $teacherId = trim($_GET["teacher_id"]);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Collect form data
                $teacherId = $_POST['teacher_id'];
                $slotDate = $_POST['slot_date'];
                $fromTime = $_POST['from_time'];
                $toTime = $_POST['to_time'];

                // Calculate duration in seconds
                $fromTimestamp = strtotime($fromTime);
                $toTimestamp = strtotime($toTime);
                $durationSeconds = $toTimestamp - $fromTimestamp;

                // Convert duration to hours
                $durationHours = $durationSeconds / (60 * 60); // 1 hour = 60 minutes * 60 seconds
            
                // Insert the data into the Slots table
                $query = "INSERT INTO Slots (Teacher_ID, Slot_Date, From_Time, To_Time, Duration_Hours) 
                          VALUES ('$teacherId', '$slotDate', '$fromTime', '$toTime', '$durationHours')";

                if ($conn->query($query) === TRUE) {
                    echo "<script>
                        alert('New Slot Added Successfully');
                        window.location.href = 'teacher_management.php';
                        </script>";
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }

                // Close the database connection
                $conn->close();
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="teacher_id" value="<?php echo $teacherId; ?>">
                <label for="slot_date">Slot Date:</label>
                <input type="date" id="slot_date" name="slot_date" required>
                <label for="from_time">From Time:</label>
                <input type="time" id="from_time" name="from_time" required>
                <label for="to_time">To Time:</label>
                <input type="time" id="to_time" name="to_time" required>
                <button type="submit">Add Slot</button>
            </form>
        </div>
    </div>
</body>

</html>