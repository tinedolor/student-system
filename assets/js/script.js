// Grade filtering
document.addEventListener('DOMContentLoaded', function() {
    const gradeFilter = document.getElementById('gradeFilter');
    if (gradeFilter) {
        gradeFilter.addEventListener('submit', function(e) {
            e.preventDefault();
            const semester = this.elements.semester.value;
            const year = this.elements.year.value;
            
            // In a real application, this would make an AJAX call to filter grades
            alert(`Filtering by Semester: ${semester || 'All'}, Year: ${year || 'All'}`);
            // This is just a placeholder - you would implement actual filtering logic
        });
    }
    
    // Password validation
    const changePasswordForm = document.querySelector('.change-password form');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            const newPassword = this.elements.new_password.value;
            const confirmPassword = this.elements.confirm_password.value;
            
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('New passwords do not match!');
            }
            
            // You could add more password strength validation here
        });
    }
});