<?php
require_once 'config.php';

// Create connection as a global variable
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset if needed
$conn->set_charset("utf8mb4");
?>