document.addEventListener("DOMContentLoaded", function () {
    const filterPanel = document.querySelector(".filter-panel");
    const courseContainer = document.querySelector(".course-container");
    const toggleButton = document.getElementById("toggle-filters-btn");

    toggleButton.addEventListener("click", function () {
        filterPanel.classList.toggle("hidden");
        courseContainer.classList.toggle("full-width");

        if (filterPanel.classList.contains("hidden")) {
            toggleButton.textContent = "⮞"; // Right arrow for show
            toggleButton.style.left = "10px"; // Move button to the left
            this.setAttribute("title", "Show Panel");
        } else {
            toggleButton.textContent = "⮜"; // Left arrow for hide
            toggleButton.style.left = "330px"; // Adjust position when visible
            this.setAttribute("title", "Hide Panel");
        }
    });
    

});


document.addEventListener("DOMContentLoaded", function () {
    const compareBtn = document.getElementById("compare-btn");
    const doneBtn = document.getElementById("done-btn");
    const courseCards = document.querySelectorAll(".course-card");
    let compareMode = false;
    let selectedCourses = [];

    // Toggle Compare Mode
    compareBtn.addEventListener("click", function () {
        compareMode = !compareMode;

        document.querySelectorAll(".course-checkbox").forEach(checkbox => {
            checkbox.style.display = compareMode ? "block" : "none"; // Show/hide checkboxes
            checkbox.checked = false; // Reset checkboxes
        });

        doneBtn.style.display = compareMode ? "inline-block" : "none";
        selectedCourses = [];
    });

    // Course Card Click Handling
    courseCards.forEach(card => {
        card.addEventListener("click", function (event) {
            if (compareMode) {
                // Prevent navigation, allow selection
                event.preventDefault();

                const checkbox = this.querySelector(".course-checkbox");
                checkbox.checked = !checkbox.checked;
                const courseId = this.getAttribute("data-id");

                if (checkbox.checked) {
                    selectedCourses.push(courseId);
                } else {
                    selectedCourses = selectedCourses.filter(id => id !== courseId);
                }
            } else {
                // Redirect normally if not in compare mode
                window.location.href = this.querySelector("a").href;
            }
        });
    });

    // Done Button Click - Navigate to Compare Page
    doneBtn.addEventListener("click", function () {
        if (selectedCourses.length > 0) {
            window.location.href = `{{ route('courses.compare') }}?courses=${selectedCourses.join(",")}`;
        } else {
            alert("Please select at least one course to compare.");
        }
    });
});

function filterFields() {
    let input = document.getElementById("filterSearch").value.toLowerCase();
    let checkboxes = document.querySelectorAll(".filter-panel label");

    checkboxes.forEach(label => {
        label.style.display = label.textContent.toLowerCase().includes(input) ? "block" : "none";
    });
}



