const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 3000;

// Create a MySQL connection pool
const pool = mysql.createPool({
    connectionLimit: 10,
    host: 'localhost',
    user: 'root',
    password: 'Niru@124',
    database: 'Miniproject1'
});

// Middleware for parsing JSON bodies
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Route to handle login requests
app.post('/login', (req, res) => {
    const { u: username, p: password } = req.body;

    // Query the database to verify credentials
    pool.query('SELECT * FROM login_user WHERE user_name = ? AND user_password = ?', [username, password], (error, results, fields) => {
        if (error) {
            console.error('Error querying database:', error);
            return res.status(500).json({ error: 'Internal server error' });
        }

        // Check if the user exists and credentials are correct
        if (results.length > 0) {
            // Redirect to the appropriate dashboard based on user role
            const role = results[0].Role;
            switch (role) {
                case 'admin':
                    return res.redirect('/admin_dashboard.html');
                case 'teacher':
                    return res.redirect('/teacher_dashboard.html');
                case 'student':
                    return res.redirect('/student_dashboard.html');
                default:
                    return res.status(401).json({ error: 'Invalid role' });
            }
        } else {
            // User not found or credentials are incorrect
            return res.status(401).json({ error: 'Invalid username or password' });
        }
    });
});

// Start the server
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
