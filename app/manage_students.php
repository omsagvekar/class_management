<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Student Management</title>
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
            text-align: left;
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

        .edit-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            max-width: 100%;
            max-height: 70%; /* Set a maximum height for the popup */
            overflow-y: auto; /* Make it scrollable */
        }

        .edit-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-form label {
            display: block;
            margin-bottom: 10px;
        }

        .edit-form input,
        .edit-form select {
            width: calc(100% - 22px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .edit-form button {
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

        .edit-form button:hover {
            background-color: #0056b3;
        }

        .edit-form .close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 20px;
            cursor: pointer;
        }

        .show-by-form select {
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            margin-block: 10px;
        }
        .show-by-form label {
            margin-right: 10px;
        }
        .show-by-form {
            margin-right: 20px; /* Added margin to separate from the dashboard */
            font-size: 18px; /* Increased font size */
        }
        .btn-group {
            display: flex;
            justify-content: space-between; /* Spread the buttons */
            margin-top: 20px; /* Add some space between buttons and form fields */
        }

        .btn-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

    .btn-group button:hover {
        background-color: #0056b3;
    }

    .confirmation-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .confirmation-popup h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .confirmation-popup .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .confirmation-popup .btn-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .confirmation-popup .btn-group button:hover {
            background-color: #0056b3;
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
        <?php include 'sidebar.php'; ?>
        <div class="dashboard">
            <div>
                <button class="logout" onclick="location.href='logout.php';"><i class="fa-solid fa-power-off"></i> Logout</button>
            </div>
            <h1>Student Management</h1>
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
                        <th>Name</th>
                        <th>Standard</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Include the database connection file
                    include 'db_connect.php';

                    // Query to fetch student data
                    $query = "SELECT * FROM students";

                    if (isset($_GET['standard']) && !empty($_GET['standard'])) {
                        // Filter by selected standard
                        $standard = $_GET['standard'];
                        $query .= " WHERE standard = $standard";
                    }


                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["roll_number"] . "</td>";
                            echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                            echo "<td>" . $row["standard"] . "</td>";
                            echo "<td>";
                            echo "<button onclick=\"editStudent(" . htmlentities(json_encode($row), ENT_QUOTES, 'UTF-8') . ")\">Edit</button>";
                            echo "<button onclick=\"deleteStudent('" . $row["student_id"] . "')\">Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No students found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                ?>

                </tbody>
            </table>
            <div class="action-buttons">
                <a href="add_student.php"><button>Add New Student</button></a>
            </div>
        </div>
    </div>

    <div id="editModal" class="edit-form">
        <span class="close-btn" onclick="closeEditModal()">&times;</span>
        <h2>Edit Student</h2>
        <form id="editStudentForm" onsubmit="saveEdit(); return false;">
            <input type="hidden" id="editRollNumber" name="editRollNumber">
            <div class="form-group">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName" autocapitalize="words" required>
            </div>
            <div class="form-group">
                <label for="editMiddleName">Middle Name:</label>
                <input type="text" id="editMiddleName" name="editMiddleName" autocapitalize="words">
            </div>
            <div class="form-group">
                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="editLastName" autocapitalize="words" required>
            </div>
            <div class="form-group">
                <label for="editDOB">Date of Birth:</label>
                <input type="date" id="editDOB" name="editDOB" required>
            </div>
            <div class="form-group">
                <label for="editGender">Gender:</label>
                <select id="editGender" name="editGender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="editAddressStreet">Street:</label>
                <input type="text" id="editAddressStreet" name="editAddressStreet">
            </div>
            <div class="form-group">
                <label for="editAddressCity">City:</label>
                <input type="text" id="editAddressCity" name="editAddressCity">
            </div>
            <div class="form-group">
                <label for="editAddressState">State:</label>
                <input type="text" id="editAddressState" name="editAddressState">
            </div>
            <div class="form-group">
                <label for="editAddressZip">Zip:</label>
                <input type="text" id="editAddressZip" name="editAddressZip">
            </div>
            <div class="form-group">
                <label for="editContactNumber">Contact Number:</label>
                <input type="text" id="editContactNumber" name="editContactNumber">
            </div>
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="editEmail">
            </div>
            <div class="form-group">
                <label for="editGuardianName">Guardian Name:</label>
                <input type="text" id="editGuardianName" name="editGuardianName">
            </div>
            <div class="form-group">
                <label for="editGuardianRelationship">Guardian Relationship:</label>
                <input type="text" id="editGuardianRelationship" name="editGuardianRelationship">
            </div>
            <div class="form-group">
                <label for="editGuardianContactNumber">Guardian Contact Number:</label>
                <input type="text" id="editGuardianContactNumber" name="editGuardianContactNumber">
            </div>
            <div class="form-group">
                <label for="editGuardianEmail">Guardian Email:</label>
                <input type="email" id="editGuardianEmail" name="editGuardianEmail">
            </div>
            <div class="form-group">
                <label for="editAdmissionDate">Admission Date:</label>
                <input type="date" id="editAdmissionDate" name="editAdmissionDate">
            </div>
            <div class="form-group btn-group">
                <button type="submit">Save</button>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </div>
        </form>
    </div>

    <div id="confirmationPopup" class="confirmation-popup">
        <h3>Are you sure you want to delete this student?</h3>
        <div class="btn-group">
            <button onclick="confirmDelete()">Yes</button>
            <button onclick="cancelDelete()">No</button>
        </div>
    </div>


    <script>
        function editStudent(student) {
            // Fill the form fields with student data
            document.getElementById("editRollNumber").value = student.roll_number;
            document.getElementById("editFirstName").value = student.first_name;
            document.getElementById("editMiddleName").value = student.middle_name || ''; // If middle_name is null, set it as empty string
            document.getElementById("editLastName").value = student.last_name;
            document.getElementById("editDOB").value = student.date_of_birth;
            document.getElementById("editGender").value = student.gender;
            document.getElementById("editAddressStreet").value = student.address_street;
            document.getElementById("editAddressCity").value = student.address_city;
            document.getElementById("editAddressState").value = student.address_state;
            document.getElementById("editAddressZip").value = student.address_zip;
            document.getElementById("editContactNumber").value = student.contact_number;
            document.getElementById("editEmail").value = student.email || ''; // If email is null, set it as empty string
            document.getElementById("editGuardianName").value = student.guardian_name || ''; // If guardian_name is null, set it as empty string
            document.getElementById("editGuardianRelationship").value = student.guardian_relationship || ''; // If guardian_relationship is null, set it as empty string
            document.getElementById("editGuardianContactNumber").value = student.guardian_contact_number || ''; // If guardian_contact_number is null, set it as empty string
            document.getElementById("editGuardianEmail").value = student.guardian_email || ''; // If guardian_email is null, set it as empty string
            document.getElementById("editAdmissionDate").value = student.admission_date;
            
            // Show the edit modal
            document.getElementById("editModal").style.display = "block";
        }
        function saveEdit() {
            var formData = new FormData(document.getElementById("editStudentForm"));

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_student.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    closeEditModal();
                }
            };
            xhr.send(formData);
        }

        function closeEditModal() {
            document.getElementById("editModal").style.display = "none";
        }

        var studentIdToDelete; // Variable to store the student ID of the student to delete

    function deleteStudent(studentId) {
        // Store the student ID of the student to delete
        studentIdToDelete = studentId;

        // Show the confirmation popup
        document.getElementById("confirmationPopup").style.display = "block";
    }

    function confirmDelete() {
        // Get the student ID of the student to delete
        var studentId = studentIdToDelete;

        // Perform AJAX request to delete the student
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_student.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText.trim();
                    if (response === "success") {
                        // Student deleted successfully
                        alert("Student deleted successfully.");
                        // Refresh the page or update the student list
                        location.reload(); // Reload the page to update the student list
                    } else {
                        // Show error message or handle error
                        alert("Error deleting student. Please try again.");
                    }
                } else {
                    // Show error message if request fails
                    alert("Error: " + xhr.status);
                }
            }
        };
        xhr.send("studentId=" + encodeURIComponent(studentId)); // Pass only the student ID of the student to delete

        // Close the confirmation popup
        document.getElementById("confirmationPopup").style.display = "none";
    }

        function cancelDelete() {
            // Close the confirmation popup without deleting the student
            document.getElementById("confirmationPopup").style.display = "none";
        }
    </script>
</body>
</html>
