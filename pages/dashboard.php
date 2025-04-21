<?php
require_once __DIR__ . '/../includes/auth.php';
redirectIfNotLoggedIn();

$student = getStudentData();

// Check if student data was retrieved
if (!$student) {
    die("Unable to retrieve student data");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">Student Portal</h1>
            <ul class="nav-links">
                <li><a href="dashboard.php" class="active">Home</a></li>
                <li><a href="grades.php">View Grades</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
            <div class="welcome-msg">
                Welcome, <?= htmlspecialchars($student['FirstName']) ?>
            </div>
        </div>
    </nav>

    <main class="container">
        <section class="welcome-section">
            <h2>Student Dashboard</h2>
            <div class="info-card">
                <h3>Your Information</h3>
                <p><strong>Name:</strong> <?= htmlspecialchars($student['FirstName'] . ' ' . $student['LastName']) ?></p>
                <p><strong>Student ID:</strong> <?= htmlspecialchars($student['StudentId']) ?></p>
                <p><strong>Course:</strong> <?= htmlspecialchars($student['Course']) ?></p>
                <p><strong>Section:</strong> <?= htmlspecialchars($student['Section']) ?></p>
            </div>
        </section>

        <section class="announcements">
            <h2>Latest Announcements</h2>
            <div class="announcement-card">
                <h3>Midterm Exams Schedule</h3>
                <p>The midterm examinations will begin next week. Please check your schedule.</p>
            </div>
            <div class="announcement-card">
                <h3>Registration Reminder</h3>
                <p>Course registration for next semester opens on December 1st.</p>
            </div>
        </section>
    </main>
</body>
</html>