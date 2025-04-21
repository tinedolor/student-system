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
    <title>Academic Calendar - Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/calendar.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>Jolibog Student Management System</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
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

    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-calendar-alt"></i> Academic Calendar</h1>
            <div class="calendar-controls">
                <div class="academic-term-selector">
                    <select id="term-selector" class="form-control">
                        <option value="2023-2024">2023-2024 Academic Year</option>
                        <option value="2023-fall">Fall Semester 2023</option>
                        <option value="2024-spring">Spring Semester 2024</option>
                        <option value="2024-summer">Summer Term 2024</option>
                    </select>
                </div>
                <button id="print-calendar" class="btn btn-outline">
                    <i class="fas fa-print"></i> Print Calendar
                </button>
            </div>
        </div>

        <div class="calendar-view">
            <!-- Month View Toggle -->
            <div class="view-toggle">
                <button class="btn btn-sm active" data-view="month"><i class="fas fa-calendar"></i> Month</button>
                <button class="btn btn-sm" data-view="list"><i class="fas fa-list"></i> List</button>
            </div>

            <!-- Month Grid View -->
            <div class="month-view" id="month-view">
                <div class="month-header">
                    <button id="prev-month" class="btn btn-icon"><i class="fas fa-chevron-left"></i></button>
                    <h2 id="current-month">September 2023</h2>
                    <button id="next-month" class="btn btn-icon"><i class="fas fa-chevron-right"></i></button>
                </div>
                
                <div class="weekdays-header">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                
                <div class="month-grid" id="month-grid">
                    <!-- Calendar days will be populated by JavaScript -->
                </div>
            </div>

            <!-- List View -->
            <div class="list-view hidden" id="list-view">
                <div class="semester-events">
                    <h3><i class="fas fa-calendar-day"></i> Important Dates</h3>
                    <div class="event-filters">
                        <div class="filter-group">
                            <label class="checkbox-container">
                                <input type="checkbox" checked data-category="academic">
                                <span class="checkmark"></span>
                                Academic
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" checked data-category="holiday">
                                <span class="checkmark"></span>
                                Holidays
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" checked data-category="registration">
                                <span class="checkmark"></span>
                                Registration
                            </label>
                        </div>
                    </div>
                    
                    <div class="event-list" id="event-list">
                        <!-- Events will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Data (would normally come from database) -->
    <script>
        const academicEvents = [
            {
                id: 1,
                title: "First Day of Classes",
                date: "2023-09-05",
                category: "academic",
                description: "Fall semester classes begin"
            },
            {
                id: 2,
                title: "Last Day to Add/Drop",
                date: "2023-09-12",
                category: "registration",
                description: "Last day to add or drop classes without penalty"
            },
            {
                id: 3,
                title: "Midterm Examinations",
                date: "2023-10-16",
                endDate: "2023-10-20",
                category: "academic",
                description: "Midterm exams for all courses"
            },
            {
                id: 4,
                title: "Thanksgiving Break",
                date: "2023-11-22",
                endDate: "2023-11-24",
                category: "holiday",
                description: "University closed for Thanksgiving"
            },
            {
                id: 5,
                title: "Final Examinations",
                date: "2023-12-11",
                endDate: "2023-12-15",
                category: "academic",
                description: "Final exams for fall semester"
            },
            {
                id: 6,
                title: "Spring Registration Opens",
                date: "2023-11-01",
                category: "registration",
                description: "Priority registration begins for spring semester"
            },
            {
                id: 7,
                title: "Semester Ends",
                date: "2023-12-15",
                category: "academic",
                description: "Last day of fall semester"
            },
            {
                id: 8,
                title: "Spring Semester Begins",
                date: "2024-01-16",
                category: "academic",
                description: "First day of spring semester classes"
            }
        ];
    </script>

    <script src="../assets/js/calendar.js"></script>
</body>
</html>