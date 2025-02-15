function goToComparePage() {
    if (selectedCourses.length < 2) {
        alert('Please select at least 2 courses to compare.');
        return;
    }
    
    // Redirect to compare page
    window.location.href = `/compare?courses=${selectedCourses.join(',')}`;
}
