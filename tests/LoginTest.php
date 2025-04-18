<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testUsername() {
        $username = "admin";
        $this->assertEquals("admin", $username);
    }
}
