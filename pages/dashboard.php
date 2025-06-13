<?php
require_once '../includes/auth.php';
redirectIfNotLoggedIn();

$student = getStudentData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Modern Navigation -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>McPortal Student Management System</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="grades.php"><i class="fas fa-chart-bar"></i> Grades</a></li>
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

    <!-- Modern Dashboard Content -->
    <div class="container">
        <div class="grid-layout">
            <!-- Sidebar -->
            <aside>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Info</h3>
                    </div>
                    <div class="student-info">
                        <p><strong>ID:</strong> <?= htmlspecialchars($student['StudentId']) ?></p>
                        <p><strong>Name:</strong> <?= htmlspecialchars($student['FirstName'] . ' ' . $student['LastName']) ?></p>
                        <p><strong>Course:</strong> <?= htmlspecialchars($student['Course']) ?></p>
                        <p><strong>Section:</strong> <?= htmlspecialchars($student['Section']) ?></p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Links</h3>
                    </div>
                    <ul class="quick-links">
                        <li><a href="academic-calendar.php"><i class="fas fa-calendar-alt"></i> Academic Calendar</a></li>
                        <li><a href="#"><i class="fas fa-book"></i> Course Materials</a></li>
                        <li><a href="https://lyceumalabang.edu.ph/"><i class="fas fa-envelope"></i> Campus Email</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <main>
                <h1 class="welcome-title">Welcome back, <?= htmlspecialchars($student['FirstName']) ?>!</h1>
                
                <!-- Announcements Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-bullhorn"></i> Announcements</h3>
                        <span class="badge">2 New</span>
                    </div>
                    <div class="announcement-list">
                        <div class="announcement-item">
                            <div class="announcement-badge new"></div>
                            <div class="announcement-content">
                                <h4>Midterm Examination Schedule</h4>
                                <p class="announcement-date">October 15, 2023</p>
                                <p>The midterm examinations will be held from November 5-9. Please check your schedules.</p>
                            </div>
                        </div>
                        <div class="announcement-item">
                            <div class="announcement-badge new"></div>
                            <div class="announcement-content">
                                <h4>Registration for Next Semester</h4>
                                <p class="announcement-date">October 10, 2023</p>
                                <p>Online registration for the next semester will open on November 15. Prepare your courses.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-calendar-day"></i> Upcoming Events</h3>
                    </div>
                    <div class="events-list">
                        <div class="event-item">
                            <div class="event-date">
                                <span class="event-day">05</span>
                                <span class="event-month">NOV</span>
                            </div>
                            <div class="event-details">
                                <h4>Midterm Exams Begin</h4>
                                <p>All courses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>