<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassMaster - Student Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .dashboard {
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
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
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
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

        .action-buttons button {
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

        .add-student-form {
            display: none;
            margin-top: 20px;
        }

        .add-student-form input {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .add-student-form button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-student-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Student Management</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Grade Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Grade 10</td>
                    <td>
                        <button onclick="editStudent(1)">Edit</button>
                        <button onclick="deleteStudent(1)">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows for other students -->
            </tbody>
        </table>
        <div class="action-buttons">
            <button onclick="toggleAddStudentForm()">Add New Student</button>
            <button onclick="recordAttendance()">Record Attendance</button>
            <button onclick="generateProgressReports()">Generate Progress Reports</button>
        < <div class="add-student-form">
            <h2>Add New Student</h2>
            <form method="post" action="">
                <!-- Added form element -->
                <input type="text" name="Roll_no" placeholder="Roll_no">
                <input type="text" name="F_name" placeholder="F_name">
                <input type="text" name="L_name" placeholder="L_name">
                <input type="text" name="STD" placeholder="STD">
                <input type="text" name="FEES_ID" placeholder="FEES_ID">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function toggleAddStudentForm() {
            var addStudentForm = document.querySelector('.add-student-form');
            addStudentForm.style.display = addStudentForm.style.display === 'none' ? 'block' : 'none';
        }

        function submitNewStudent() {
            var Roll_no = document.getElementById('Roll_no').value;
            var F_name = document.getElementById('F_name').value;
            var L_name = document.getElementById('L_name').value;
            var STD = document.getElementById('STD').value;
            var FEES_ID = document.getElementById('FEES_ID').value;
            // Placeholder logic to submit new student data to server
            console.log("Roll_no: " + Roll_no);
            console.log("F_name: " + F_name);
            console.log("L_name: " + L_name);
            console.log("STD: " + STD);
            console.log("FEES_ID: " + FEES_ID);




            // You can replace console.log with actual AJAX call to submit data
        }

        function editStudent(studentId) {
            // Placeholder logic to edit student with the given ID
            alert("Editing student with ID: " + studentId);
            // Replace alert with actual edit logic
        }

        function deleteStudent(studentId) {
            // Placeholder logic to delete student with the given ID
            alert("Deleting student with ID: " + studentId);
            // Replace alert with actual delete logic
        }

        function recordAttendance() {
            // Placeholder logic to navigate to the record attendance page or display a form
            alert("Redirecting to Record Attendance page...");
            // Replace alert with actual navigation logic
        }

        function generateProgressReports() {
            // Placeholder logic to navigate to the generate progress reports page or initiate report generation
            alert("Redirecting to Generate Progress Reports page...");
            // Replace alert with actual navigation logic
        }
        <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Roll_no']) && isset($_POST['F_name']) && isset($_POST['L_name']) && isset($_POST['STD']) && isset($_POST['FEES_ID'])) {
        // Retrieve data from the POST request
        $Roll_no = $_POST['Roll_no'];
        $F_name = $_POST['F_name'];
        $L_name = $_POST['L_name'];
        $STD = $_POST['STD'];
        $FEES_ID = $_POST['FEES_ID'];

        // Perform database connection (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "Niru@1234";
        $dbname = "miniproject";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL statement to insert data into the database
        $sql = "INSERT INTO students (Roll_no, F_name, L_name, STD, FEES_ID) VALUES ('$Roll_no', '$F_name', '$L_name', '$STD', '$FEES_ID')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("New record created successfully");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>


</script>

    
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>

</html>