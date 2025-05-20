<?php
require_once '../includes/auth.php';
redirectIfNotLoggedIn();

$studentId = $_SESSION['student_id'];
$student = getStudentData();

global $conn;
$sql = "SELECT g.*, s.SubjectName, f.LastName as FacultyLastName 
        FROM gradetable g
        JOIN subjecttable s ON g.Subjectcode = s.subjectcode
        JOIN facultytable f ON s.facultyId = f.FacultyId
        WHERE g.StudentId = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("s", $studentId);
$stmt->execute();
$grades = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades - Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>Jolibog Student Management System</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="grades.php" class="active"><i class="fas fa-chart-bar"></i> Grades</a></li>
            <li><a href="profile.php"><i class="fas fa-user-cog"></i> Profile</a></li>
            <li><a href="academic-calendar.php"><i class="fas fa-calendar-alt"></i> Academic Calendar</a></li>
        </ul>
        <div class="user-profile">
            <div class="avatar">
                <?= substr($student['FirstName'], 0, 1) . substr($student['LastName'], 0, 1) ?>
            </div>
            <a href="../logout.php" class="btn btn-outline">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-graduation-cap"></i> Academic Grades</h2>
                <div class="grade-filter">
                    <select class="form-control" style="width: 150px;">
                        <option>All Semesters</option>
                        <option>Fall 2023</option>
                        <option>Spring 2024</option>
                    </select>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Instructor</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Pre-Final</th>
                            <th>Final</th>
                            <th>Status</th>
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
                                <span class="status-badge <?= ($grade['Final'] ?? 0) >= 75 ? 'success' : 'danger' ?>">
                                    <?= ($grade['Final'] ?? 0) >= 75 ? 'Passed' : 'Failed' ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>