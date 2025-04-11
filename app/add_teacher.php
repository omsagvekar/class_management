<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
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
            flex: 1;
            /* Allow the content area to grow */
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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
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
            <h1>Add Teacher</h1>
              <form action="insert_teacher.php" method="POST">
                <!-- <label for="T_ID">T_id</label><br> -->
                <!-- <input type="number" id="T_ID" name="T_ID" required><br> -->

                <label for="first_name">First Name:</label><br>
                <input type="text" id="first_name" name="first_name" required><br>

                <label for="middle_name">Middle Name:</label><br>
                <input type="text" id="middle_name" name="middle_name"><br>

                <label for="last_name">Last Name:</label><br>
                <input type="text" id="last_name" name="last_name" required><br>

                <label for="date_of_birth">Date of Birth:</label><br>
                <input type="date" id="date_of_birth" name="date_of_birth" required><br>

                <label for="gender">Gender:</label><br>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>

                <label for="qualification">Qualification:</label><br>
                <input type="text" id="qualification" name="qualification" required><br>

                <label for="year_of_experience">Year of Experience:</label><br>
                <input type="number" id="year_of_experience" name="year_of_experience" required><br>

                <label for="address_street">Street Address:</label><br>
                <input type="text" id="address_street" name="address_street" required><br>

                <label for="address_city">City:</label><br>
                <input type="text" id="address_city" name="address_city" required><br>

                <label for="address_state">State:</label><br>
                <input type="text" id="address_state" name="address_state" required><br>

                <label for="address_zip">Zip Code:</label><br>
                <input type="text" id="address_zip" name="address_zip" required><br>

                <label for="contact_number">Contact Number:</label><br>
                <input type="text" id="contact_number" name="contact_number" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>

                <label for="date_of_joining">Date of Joining:</label><br>
                <input type="date" id="date_of_joining" name="date_of_joining" required><br>

                <label for="pay_per_hour">Pay Per Hour:</label><br>
                <input type="text" id="pay_per_hour" name="pay_per_hour" required><br><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>
