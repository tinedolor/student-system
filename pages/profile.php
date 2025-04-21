<?php
require_once __DIR__ . '/../includes/auth.php';
redirectIfNotLoggedIn();

$student = getStudentData();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Verify current password
    $sql = "SELECT Password FROM studentlogin WHERE StudentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['student_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($currentPassword === $user['Password']) {
        if ($newPassword === $confirmPassword) {
            // Update password (in production, use password_hash())
            $updateSql = "UPDATE studentlogin SET Password = ? WHERE StudentId = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $newPassword, $_SESSION['student_id']);
            
            if ($updateStmt->execute()) {
                $message = "Password updated successfully!";
            } else {
                $message = "Error updating password: " . $conn->error;
            }
        } else {
            $message = "New passwords don't match.";
        }
    } else {
        $message = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - Profile</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Navigation Bar (same as dashboard) -->
    <nav class="navbar">
        <div class="container">
            <h1 class="logo"><?= SITE_NAME ?></h1>
            <ul class="nav-links">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="grades.php"><i class="fas fa-graduation-cap"></i> View Grades</a></li>
                <li><a href="profile.php" class="active"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
            <div class="welcome-msg">
                Welcome, <?= htmlspecialchars($student['FirstName']) ?>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <main class="container profile-container">
        <section class="profile-info">
            <h1><i class="fas fa-user"></i> My Profile</h1>
            
            <div class="info-card">
                <h3>Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Student ID:</label>
                        <p><?= htmlspecialchars($student['StudentId']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Full Name:</label>
                        <p><?= htmlspecialchars($student['FirstName'] . ' ' . $student['LastName']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Course:</label>
                        <p><?= htmlspecialchars($student['Course']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Section:</label>
                        <p><?= htmlspecialchars($student['Section']) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="password-change">
            <h2><i class="fas fa-key"></i> Change Password</h2>
            
            <?php if ($message): ?>
                <div class="alert <?= strpos($message, 'successfully') !== false ? 'success' : 'error' ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="password-form">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn">Update Password</button>
            </form>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="../assets/js/profile.js"></script>
</body>
</html>