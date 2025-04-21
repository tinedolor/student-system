<?php
require_once __DIR__ . '/../includes/auth.php';
redirectIfNotLoggedIn();

$studentId = $_SESSION['student_id'];
$student = getStudentData();

// Fetch grades from database
global $conn;
$sql = "SELECT g.*, s.SubjectName, f.LastName as FacultyLastName 
        FROM gradetable g
        JOIN subjecttable s ON g.SubjectId = s.SubjectId
        JOIN facultytable f ON s.facultyId = f.FacultyId
        WHERE g.StudentId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentId);
$stmt->execute();
$grades = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - My Grades</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Navigation Bar (same as dashboard) -->
    <nav class="navbar">
        <div class="container">
            <h1 class="logo"><?= SITE_NAME ?></h1>
            <ul class="nav-links">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="grades.php" class="active"><i class="fas fa-graduation-cap"></i> View Grades</a></li>
                <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
            <div class="welcome-msg">
                Welcome, <?= htmlspecialchars($student['FirstName']) ?>
            </div>
        </div>
    </nav>

    <!-- Grades Content -->
    <main class="container">
        <h1><i class="fas fa-graduation-cap"></i> My Grades</h1>
        
        <div class="grades-filter">
            <form id="filterForm">
                <select name="semester">
                    <option value="">All Semesters</option>
                    <option value="1">First Semester</option>
                    <option value="2">Second Semester</option>
                </select>
                <select name="year">
                    <option value="">All Years</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
                <button type="submit" class="btn">Filter</button>
            </form>
        </div>

        <div class="grades-table-container">
            <table class="grades-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Professor</th>
                        <th>Prelim</th>
                        <th>Midterm</th>
                        <th>Pre-Final</th>
                        <th>Final</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grades as $grade): ?>
                    <tr>
                        <td><?= htmlspecialchars($grade['SubjectName']) ?></td>
                        <td>Prof. <?= htmlspecialchars($grade['FacultyLastName']) ?></td>
                        <td><?= $grade['Prelim'] ?? '-' ?></td>
                        <td><?= $grade['Midterm'] ?? '-' ?></td>
                        <td><?= $grade['PreFinal'] ?? '-' ?></td>
                        <td><?= $grade['Final'] ?? '-' ?></td>
                        <td>
                            <?php 
                            $finalGrade = $grade['Final'] ?? 0;
                            echo $finalGrade >= 75 ? 'Passed' : 'Failed';
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="../assets/js/grades.js"></script>
</body>
</html>