<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassMaster - Teacher Management</title>
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
            position: relative;
            overflow-x: auto;
            /* Enable horizontal scrolling if needed */
        }

        .dashboard {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
            /* Enable horizontal scrolling if needed */
        }

        .sidebar {
            width: 270px;
            background-color: #007bff;
            color: #fff;
            padding: 20px 10px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #0056b3;
        }

        .edit-form-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            max-width: 80%;
            display: none;
            overflow-y: auto;
            /* Enable vertical scrolling */
            max-height: 80vh;
            /* Set max height to 80% of viewport height */
        }

        .edit-form-container.active {
            display: block;
        }

        .edit-form {
            max-width: 100%;
        }

        h2 {
            text-align: left;
            margin-bottom: 20px;
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

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .logout {
            position: relative;
            top: 5px;
            right: -900px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            /* Adding transition */
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
                <button class="logout" onclick="location.href='logout.php';"><i class="fa-solid fa-power-off"></i>
                    Logout</button>
            </div>
            <h1>Teacher Management</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Qualification</th>
                        <th>Pay Per Hour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include 'db_connect.php';

                    // Query to fetch teacher data
                    $query = "SELECT T_ID, CONCAT(first_name, ' ', last_name) AS Name, qualification, pay_per_hour FROM Teachers";

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["T_ID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["qualification"] . "</td>";
                            echo "<td>" . $row["pay_per_hour"] . "</td>";
                            echo "<td>";
                            echo "<button onclick=\"editTeacher(" . $row["T_ID"] . ")\">Edit</button>";
                            echo '<button onclick="deleteTeacher(' . $row["T_ID"] . ')">Delete</button>';
                            echo '<button class="add-slot-button" onclick="addSlot(' . $row["T_ID"] . ')">Add Slot</button>';
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No teachers found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <div class="action-buttons">
                <a href="add_teacher.php"><button>Add New Teacher</button></a>
                <button onclick="calculateSalary()">Calculate Salary</button>
            </div>
        </div>
    </div>

    <!-- Modal for editing teacher -->
    <div id="editModal" class="edit-form-container">
        <div class="edit-form">
            <span class="close-btn" onclick="closeEditModal()">&times;</span>
            <h2>Edit Teacher</h2>
            <form id="editTeacherForm" action="update_teacher.php" method="post">
                <input type="hidden" name="teacher_id" value="">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="" required>
                <label for="middle_name">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name" value="">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="" required>
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" value="" required>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" value="" required>
                <label for="year_of_experience">Year of Experience:</label>
                <input type="text" id="year_of_experience" name="year_of_experience" value="" required>
                <label for="address_street">Street Address:</label>
                <input type="text" id="address_street" name="address_street" value="" required>
                <label for="address_city">City:</label>
                <input type="text" id="address_city" name="address_city" value="" required>
                <label for="address_state">State:</label>
                <input type="text" id="address_state" name="address_state" value="" required>
                <label for="address_zip">ZIP Code:</label>
                <input type="text" id="address_zip" name="address_zip" value="" required>
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" value="" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="" required>
                <label for="date_of_joining">Date of Joining:</label>
                <input type="date" id="date_of_joining" name="date_of_joining" value="" required>
                <label for="pay_per_hour">Pay Per Hour:</label>
                <input type="text" id="pay_per_hour" name="pay_per_hour" value="" required>
                <button type="submit">Update Teacher</button>
            </form>
        </div>
    </div>

    <script>
        function editTeacher(teacherId) {
            // Logic to edit teacher with the given ID
            document.getElementById("editModal").classList.add("active");
            // Fetch teacher data via AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var teacherData = JSON.parse(this.responseText);
                    document.getElementById("editTeacherForm").setAttribute("action", "update_teacher.php?id=" + teacherId);
                    document.querySelector("#editModal [name='teacher_id']").value = teacherId;
                    document.getElementById("first_name").value = teacherData.first_name;
                    document.getElementById("middle_name").value = teacherData.middle_name;
                    document.getElementById("last_name").value = teacherData.last_name;
                    document.getElementById("date_of_birth").value = teacherData.date_of_birth;
                    document.getElementById("gender").value = teacherData.gender;
                    document.getElementById("qualification").value = teacherData.qualification;
                    document.getElementById("year_of_experience").value = teacherData.year_of_experience;
                    document.getElementById("address_street").value = teacherData.address_street;
                    document.getElementById("address_city").value = teacherData.address_city;
                    document.getElementById("address_state").value = teacherData.address_state;
                    document.getElementById("address_zip").value = teacherData.address_zip;
                    document.getElementById("contact_number").value = teacherData.contact_number;
                    document.getElementById("email").value = teacherData.email;
                    document.getElementById("date_of_joining").value = teacherData.date_of_joining;
                    document.getElementById("pay_per_hour").value = teacherData.pay_per_hour;
                }
            };
            xhr.open("GET", "get_teacher.php?id=" + teacherId, true);
            xhr.send();
        }

        function deleteTeacher(teacherId) {
            // Logic to delete teacher with the given ID
            window.location.href = "delete_teacher.php?id=" + teacherId;
        }

        function addSlot(teacherId) {
            // Logic to redirect to add_slot.php with the teacher ID
            window.location.href = "add_slot.php?teacher_id=" + teacherId;
        }

        function calculateSalary() {
            // Logic to calculate salary for teachers
            window.location.href = "calculate.php?";
        }

        function closeEditModal() {
            // Logic to close the edit modal
            document.getElementById("editModal").classList.remove("active");
        }
    </script>
</body>

</html>