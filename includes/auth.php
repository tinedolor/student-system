<?php
session_start();

// Require the database connection
require_once __DIR__ . '/db_connect.php';

function isLoggedIn() {
    return isset($_SESSION['student_id']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: ../index.php");
        exit();
    }
}

function getStudentData() {
    global $conn;
    
    if (!isLoggedIn()) {
        return null;
    }
    
    $studentId = $_SESSION['student_id'];
    $sql = "SELECT * FROM studenttable WHERE StudentId = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>