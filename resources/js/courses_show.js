let selectedCourses = [];

function clearCompareBox() {
    let selectedCourses = document.getElementById("selected-courses");
    selectedCourses.innerHTML = '<p id="placeholder-text">Drag and drop courses here to compare</p>'; // Restore placeholder
}

// Ensure compare button works
document.getElementById("clear-btn").addEventListener("click", clearCompareBox);

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('click', function (event) {
            // Prevent the click event from bubbling up to parent elements
            event.stopPropagation();

            // Get the course URL from the data attribute
            const courseUrl = this.getAttribute('data-course-url');

            // Redirect to the course details page
            if (courseUrl) {
                window.location.href = courseUrl;
            }
        });
    });
});
// Define enableDragDrop in the global scope
function enableDragDrop() {
    document.querySelectorAll('.course-card').forEach(card => {
        card.setAttribute('draggable', 'true'); // Force draggable attribute

        card.addEventListener('dragstart', function (event) {
            let courseId = this.getAttribute('data-course-id');
            let courseName = this.querySelector('.course-title')?.innerText || 'Unknown Course';

            if (courseId) {
                event.dataTransfer.setData('courseId', courseId);
                event.dataTransfer.setData('courseName', courseName);
                console.log("Dragging Course:", courseName);
            }
        });
    });
}

// Define allowDrop and drop functions
function allowDrop(event) {
    event.preventDefault(); // Allow dropping
}

function drop(event) {
    event.preventDefault();
    let courseId = event.dataTransfer.getData('courseId');
    let courseName = event.dataTransfer.getData('courseName');
    let selectedCoursesContainer = document.getElementById("selected-courses");

    // Remove placeholder if it exists
    let placeholder = document.getElementById("placeholder-text");
    if (placeholder) {
        placeholder.remove();
    }

    if (courseId && !selectedCourses.includes(courseId)) {
        selectedCourses.push(courseId);

        let newElement = document.createElement("div");
        newElement.innerText = courseName;
        newElement.classList.add("selected-course");

        selectedCoursesContainer.appendChild(newElement);
    }
}

// Initialize drag-and-drop functionality
window.onload = function () {
    enableDragDrop();

    // Compare container setup
    let compareContainer = document.getElementById("compare-container");

    compareContainer.addEventListener("dragover", allowDrop);
    compareContainer.addEventListener("drop", drop);

    // Pass Laravel route dynamically from Blade
    var compareRoute = document.getElementById("compare-btn").getAttribute("data-route");

    // Compare button functionality
    document.getElementById("compare-btn").addEventListener("click", function () {
        console.log("Compare button clicked"); // Debugging
        if (selectedCourses && selectedCourses.length > 1) {
            window.location.href = `${compareRoute}?courses=${selectedCourses.join(",")}`;
        } else {
            alert("Please select at least 2 courses to compare.");
        }
    });

    // Filter functionality
    document.querySelectorAll('.filter-checkbox, #filterSearch').forEach(input => {
        input.addEventListener('input', function () {
            let form = document.getElementById('filter-form');
            let formData = new FormData();

            form.querySelectorAll('input[type="checkbox"]:checked').forEach((checkbox) => {
                formData.append(checkbox.name + "[]", checkbox.value);
            });

            let searchQuery = document.getElementById('filterSearch').value;
            if (searchQuery.trim() !== '') {
                formData.append('search', searchQuery);
            }

            let query = new URLSearchParams(formData).toString();

            fetch("/BrighterUs/public/courses/filter?" + query, {
                method: "GET",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                let coursesList = document.getElementById('courses-list');
                coursesList.innerHTML = ""; // Clear existing content

                data.courses.data.forEach(course => {
                    let courseCard = document.createElement('div');
                    courseCard.classList.add('course-card-container');
                    courseCard.dataset.courseId = course.id;

                    courseCard.innerHTML = `
                        <div class="course-card" draggable="true" data-course-id="${course.id}" data-course-url="{{ route('courses.show', $course->id) }}">
                        ${data.isAuthenticated ? `
                            <button class="bookmark-btn" data-course-id="${course.id}" onclick="toggleBookmark(this)">
                                <i class="${course.isBookmarked ? 'fas' : 'far'} fa-bookmark"></i>
                            </button>
                        ` : ''}
                            <h5 class="course-title">${course.name}</h5>
                            <hr>
                            <div class="c2">
                                <img src="${course.university ? course.university.logo : 'N/A'}">
                                <div>
                                    <p><strong>Category:</strong> ${course.category ? course.category.name : 'N/A'}</p>
                                    <p><strong>Field:</strong> ${course.field ? course.field.name : 'N/A'}</p>
                                    <p><strong>University:</strong> ${course.university ? course.university.name : 'N/A'}</p>
                                    <p><strong>QS Ranking:</strong> ${course.ranking ? course.ranking.value : 'N/A'}</p>
                                </div>
                            </div>
                            <div class="c3">
                                <p><strong>Budget:</strong><br> RM ${course.budget.toLocaleString()}</p>
                                <p><strong>Location:</strong><br> ${course.location ? course.location.name : 'N/A'}</p>
                            </div>
                        </div>
                    `;
                    courseCard.addEventListener('click', function() {
                        window.location.href = `/BrighterUs/public/courses/${course.id}`;
                    });
                    coursesList.appendChild(courseCard);
                    
                });

                // Reapply drag-and-drop after updating courses
                enableDragDrop();
            });
        });
    });
};

function showLoginPrompt() {
    alert("Please log in to bookmark courses.");
    // Optionally, redirect to the login page
    // window.location.href = "{{ route('login') }}";
} 

function toggleBookmark(button) {
    const isLoggedIn = button.getAttribute('data-logged-in') === 'true';

    if (!isLoggedIn) {
        showLoginPrompt();
        return;
    }
    const courseId = button.getAttribute('data-course-id');
    const icon = button.querySelector('i');

    fetch(`courses/${courseId}/bookmark`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'added') {
            icon.classList.remove('far'); // Remove outline icon
            icon.classList.add('fas'); // Add filled icon
        } else if (data.status === 'removed') {
            icon.classList.remove('fas'); // Remove filled icon
            icon.classList.add('far'); // Add outline icon
        }
    })
    .catch(error => console.error('Error:', error));
}