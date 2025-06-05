<?php
require_once '../includes/auth.php';
redirectIfNotLoggedIn();

$student = getStudentData();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    $sql = "SELECT Password FROM studentlogin WHERE StudentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['student_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($currentPassword === $user['Password']) {
        if ($newPassword === $confirmPassword) {
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
    <title>Profile - Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>McPortal Student Management System</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="grades.php"><i class="fas fa-chart-bar"></i> Grades</a></li>
            <li><a href="profile.php" class="active"><i class="fas fa-user-cog"></i> Profile</a></li>
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
        <div class="profile-header">
            <h1><i class="fas fa-user-circle"></i> My Profile</h1>
            <p>Manage your account settings and security</p>
        </div>
        
        <div class="profile-grid">
            <!-- Personal Information Card -->
            <div class="card profile-card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-id-card"></i> Personal Information</h3>
                </div>
                <div class="profile-info">
                    <div class="info-item">
                        <span class="info-label">Student ID</span>
                        <span class="info-value"><?= htmlspecialchars($student['StudentId']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Full Name</span>
                        <span class="info-value"><?= htmlspecialchars($student['FirstName'] . ' ' . $student['LastName']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Course</span>
                        <span class="info-value"><?= htmlspecialchars($student['Course']) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Section</span>
                        <span class="info-value"><?= htmlspecialchars($student['Section']) ?></span>
                    </div>
                </div>
            </div>
            
            <!-- Password Change Card -->
            <div class="card security-card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-shield-alt"></i> Security Settings</h3>
                </div>
                
                <?php if ($message): ?>
                    <div class="alert <?= strpos($message, 'successfully') !== false ? 'success' : 'error' ?>">
                        <i class="fas <?= strpos($message, 'successfully') !== false ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
                        <?= $message ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="security-form">
                    <div class="form-group">
                        <label for="current_password" class="form-label">
                            <i class="fas fa-key"></i> Current Password
                        </label>
                        <div class="password-input">
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password" class="form-label">
                            <i class="fas fa-lock"></i> New Password
                        </label>
                        <div class="password-input">
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-hint">Minimum 8 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">
                            <i class="fas fa-lock"></i> Confirm New Password
                        </label>
                        <div class="password-input">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility for all password fields
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });

        // Password strength indicator (optional)
        document.getElementById('new_password')?.addEventListener('input', function() {
            // Implement password strength meter if desired
        });
    </script>
</body>
</html>