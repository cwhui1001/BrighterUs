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



// document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
//     checkbox.addEventListener('change', function() {
//         let form = document.getElementById('filter-form');
//         let formData = new FormData();

//         form.querySelectorAll('input[type="checkbox"]:checked').forEach((checkbox) => {
//             formData.append(checkbox.name, checkbox.value);
//         });

//         let query = new URLSearchParams(formData).toString();

//         fetch("{{ route('courses.filter') }}?" + query, {
//             method: "GET",
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest'
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log(data);
//             let coursesList = document.getElementById('courses-list');
//             coursesList.innerHTML = "";

//             data.courses.data.forEach(course => {
//                 let courseCard = document.createElement('div');
//                 courseCard.classList.add('course-card');

//                 courseCard.innerHTML = `
//                     <h5 class="course-title">
//                         <a href="/courses/${course.id}">${course.name}</a>
//                     </h5>
//                     <hr>
//                     <p><strong>Category:</strong> ${course.category ? course.category.name : 'N/A'}</p>
//                     <p><strong>Field:</strong> ${course.field ? course.field.name : 'N/A'}</p>
//                     <p><strong>University:</strong> ${course.university ? course.university.name : 'N/A'}</p>
//                     <p><strong>Location:</strong> ${course.location ? course.location.name : 'N/A'}</p>
//                     <p><strong>Budget:</strong> $${course.budget.toLocaleString()}</p>
//                     <p><strong>Ranking:</strong> ${course.ranking}</p>
//                     <p class="course-description"><strong>Description:</strong> ${course.description}</p>
//                 `;

//                 coursesList.appendChild(courseCard);
//             });
//         })
//         .catch(error => console.error("Fetch error:", error));
        
//     });
// });