<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/index.php'; // adjust path

class LoginTest extends TestCase {
    public function testValidLogin() {
        $this->assertTrue(checkLogin('admin', 'admin'));
    }

    public function testInvalidLogin() {
        $this->assertFalse(checkLogin('admin', 'wrongpassword'));
    }
}
