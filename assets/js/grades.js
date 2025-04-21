document.addEventListener('DOMContentLoaded', function() {
    // Grade filtering functionality
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const semester = this.elements.semester.value;
            const year = this.elements.year.value;
            
            
            alert(`Filtering by: Semester ${semester || 'All'}, Year ${year || 'All'}`);
            console.log(`Filters - Semester: ${semester}, Year: ${year}`);
            

        });
    }
});