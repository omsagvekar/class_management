<?php
$response = @file_get_contents("http://localhost:8081");

if ($response && strpos($response, "Class Management") !== false) {
    echo "✅ Homepage is working.\n";
    exit(0);
} else {
    echo "❌ Homepage test failed.\n";
    exit(1);
}
?>
