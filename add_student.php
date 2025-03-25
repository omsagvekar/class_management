<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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

        .content {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            font-size: 1.5em;
            font-weight: bold;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
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
        }

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
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="content">
            <h2>Add Student</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                    <label for="f_name">First Name:</label>
                    <input type="text" id="f_name" name="first_name" autocapitalize="words" required>
                </div>
                <div class="form-group">
                    <label for="m_name">Middle Name:</label>
                    <input type="text" id="m_name" name="middle_name" autocapitalize="words" >
                </div>
                <div class="form-group">
                    <label for="l_name">Last Name:</label>
                    <input type="text" id="l_name" name="last_name" autocapitalize="words" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="standard">Standard:</label>
                    <select id="standard" name="standard" required>
                        <option value="">Select Standard</option>
                        <option value="7">7th</option>
                        <option value="8">8th</option>
                        <option value="9">9th</option>
                        <option value="10">10th</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="roll_number">Roll Number:</label>
                    <input type="text" id="roll_number" name="roll_number" readonly>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="guardian_name">Guardian's Name:</label>
                    <input type="text" id="guardian_name" name="guardian_name" required>
                </div>
                <div class="form-group">
                    <label for="guardian_relationship">Guardian's Relationship:</label>
                    <input type="text" id="guardian_relationship" name="guardian_relationship" required>
                </div>
                <div class="form-group">
                    <label for="guardian_contact_number">Guardian's Contact Number:</label>
                    <input type="text" id="guardian_contact_number" name="guardian_contact_number" required>
                </div>
                <div class="form-group">
                    <label for="guardian_email">Guardian's Email:</label>
                    <input type="email" id="guardian_email" name="guardian_email">
                </div>
                <div class="form-group">
                    <label for="admission_date">Admission Date:</label>
                    <input type="date" id="admission_date" name="admission_date" required>
                </div>
                
                <div class="form-group">
                    <label for="address_street">Street Address:</label>
                    <input type="text" id="address_street" name="address_street" required>
                </div>
                <div class="form-group">
                    <label for="address_city">City:</label>
                    <input type="text" id="address_city" name="address_city" required>
                </div>
                <div class="form-group">
                    <label for="address_state">State:</label>
                    <input type="text" id="address_state" name="address_state" autocapitalize="words" required>
                </div>
                <div class="form-group">
                    <label for="address_zip">ZIP Code:</label>
                    <input type="text" id="address_zip" name="address_zip" required>
                </div>
                <div class="form-group">
                    <label for="address_latitude">Latitude:</label>
                    <input type="text" id="address_latitude" name="address_latitude">
                </div>
                <div class="form-group">
                    <label for="address_longitude">Longitude:</label>
                    <input type="text" id="address_longitude" name="address_longitude">
                </div>
                <input type="submit" value="Add Student">
            </form>

            <?php
                include 'db_connect.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $first_name = $_POST['first_name'];
                    $middle_name = $_POST['middle_name'];
                    $last_name = $_POST['last_name'];
                    $date_of_birth = $_POST['date_of_birth'];
                    $gender = $_POST['gender'];
                    $address_street = $_POST['address_street'];
                    $address_city = $_POST['address_city'];
                    $address_state = $_POST['address_state'];
                    $address_zip = $_POST['address_zip'];
                    $contact_number = $_POST['contact_number'];
                    $email = $_POST['email'];
                    $guardian_name = $_POST['guardian_name'];
                    $guardian_relationship = $_POST['guardian_relationship'];
                    $guardian_contact_number = $_POST['guardian_contact_number'];
                    $guardian_email = $_POST['guardian_email'];
                    $admission_date = $_POST['admission_date'];
                    $roll_number = $_POST['roll_number'];
                    $standard = $_POST['standard'];
                    $address_latitude = $_POST['address_latitude'];  // New field
                    $address_longitude = $_POST['address_longitude']; // New field

                    // Insert data into database with spatial attributes
                    $sql = "INSERT INTO students 
                            (first_name, middle_name, last_name, date_of_birth, gender, 
                             address_street, address_city, address_state, address_zip, 
                             address_latitude, address_longitude, contact_number, email, 
                             guardian_name, guardian_relationship, guardian_contact_number, 
                             guardian_email, admission_date, roll_number, standard) 
                            VALUES 
                            ('$first_name', '$middle_name', '$last_name', '$date_of_birth', '$gender', 
                             '$address_street', '$address_city', '$address_state', '$address_zip', 
                             '$address_latitude', '$address_longitude', '$contact_number', '$email', 
                             '$guardian_name', '$guardian_relationship', '$guardian_contact_number', 
                             '$guardian_email', '$admission_date', '$roll_number', '$standard')";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>
                                alert('Student Added Successfully');
                                window.location.href = 'manage_students.php';
                              </script>";
                    } else {
                        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                    }

                    $conn->close();
                }
            ?>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var standardSelect = document.getElementById("standard");
        var rollNumberInput = document.getElementById("roll_number");

        standardSelect.addEventListener("change", function() {
            var selectedStandard = standardSelect.value;

            // Send an AJAX request to the server to get the next roll number
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    rollNumberInput.value = xhr.responseText;
                }
            };
            xhr.open("GET", "get_roll_number.php?standard=" + selectedStandard, true);
            xhr.send();
        });
        });     
    </script>
</body>
</html>