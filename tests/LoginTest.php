<?php
namespace Tests;  // Added namespace

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testValidLogin()
    {
        $username = 'admin';
        $password = 'Admin';

        $conn = new mysqli('class_db', 'user', 'password', 'new_classroom');
        $stmt = $conn->prepare("SELECT * FROM login_user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        $this->assertGreaterThan(0, $result->num_rows, "Login failed with valid credentials.");
    }

    public function testInvalidLogin()
    {
        $username = 'wrong';
        $password = 'user';

        $conn = new mysqli('class_db', 'user', 'password', 'new_classroom');
        $stmt = $conn->prepare("SELECT * FROM login_user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        $this->assertEquals(0, $result->num_rows, "Login succeeded with invalid credentials.");
    }
}
