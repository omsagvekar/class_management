<?php
// Include the database connection file
include 'db_connect.php';

// Check if the teacher ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Fetch the teacher data based on the ID
    $teacher_id = $_GET['id'];
    $query = "SELECT * FROM Teachers WHERE T_ID = $teacher_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch the teacher data as an associative array
        $teacher = $result->fetch_assoc();
    } else {
        // Redirect to a page showing error message if teacher not found
        header("Location: teacher_not_found.php");
        exit();
    }
} else {
    // Redirect to a page showing error message if teacher ID is not provided
    header("Location: teacher_id_missing.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Edit Teacher</title>
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
            max-width: 600px;
            margin: auto;
        }

        .edit-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: calc(100% - 22px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px 0;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="edit-form">
            <h2>Edit Teacher</h2>
            <form action="update_teacher.php" method="post">
                <input type="hidden" name="teacher_id" value="<?php echo $teacher['T_ID']; ?>">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $teacher['first_name']; ?>" required>
                <label for="middle_name">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name" value="<?php echo $teacher['middle_name']; ?>">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $teacher['last_name']; ?>" required>
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $teacher['date_of_birth']; ?>" required>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php if ($teacher['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($teacher['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($teacher['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                </select>
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" value="<?php echo $teacher['qualification']; ?>" required>
                <label for="year_of_experience">Year of Experience:</label>
                <input type="text" id="year_of_experience" name="year_of_experience" value="<?php echo $teacher['year_of_experience']; ?>" required>
                <label for="address_street">Street Address:</label>
                <input type="text" id="address_street" name="address_street" value="<?php echo $teacher['address_street']; ?>" required>
                <label for="address_city">City:</label>
                <input type="text" id="address_city" name="address_city" value="<?php echo $teacher['address_city']; ?>" required>
                <label for="address_state">State:</label>
                <input type="text" id="address_state" name="address_state" value="<?php echo $teacher['address_state']; ?>" required>
                <label for="address_zip">ZIP Code:</label>
                <input type="text" id="address_zip" name="address_zip" value="<?php echo $teacher['address_zip']; ?>" required>
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" value="<?php echo $teacher['contact_number']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $teacher['email']; ?>" required>
                <label for="date_of_joining">Date of Joining:</label>
                <input type="date" id="date_of_joining" name="date_of_joining" value="<?php echo $teacher['date_of_joining']; ?>" required>
                <label for="pay_per_hour">Pay Per Hour:</label>
                <input type="text" id="pay_per_hour" name="pay_per_hour" value="<?php echo $teacher['pay_per_hour']; ?>" required>
                <button type="submit">Update Teacher</button>
            </form>
        </div>
    </div>
</body>

</html>
