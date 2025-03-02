let selectedCourses = [];

function goToComparePage() {
    if (selectedCourses.length < 2) {
        alert('Please select at least 2 courses to compare.');
        return;
    }
    
    // Redirect to compare page
    window.open(`/compare?courses=${selectedCourses.join(',')}`, '_blank');}



function clearCompareBox() {
    let selectedCourses = document.getElementById("selected-courses");
    selectedCourses.innerHTML = '<p id="placeholder-text">Drag and drop courses here to compare</p>'; // Restore placeholder
}

// Ensure compare button works
document.getElementById("clear-btn").addEventListener("click", clearCompareBox);



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
    let data = event.dataTransfer.getData("text");
    let selectedCourses = document.getElementById("selected-courses");

    // Remove placeholder if it exists
    let placeholder = document.getElementById("placeholder-text");
    if (placeholder) {
        placeholder.remove();
    }

    let course = document.createElement("div");
    course.textContent = data;
    course.classList.add("course-item"); 
    selectedCourses.appendChild(course);
}



// drag drop feature
window.onload = function () {
    

    enableDragDrop();

    // Compare container setup
    let compareContainer = document.getElementById("compare-container");
    let selectedCoursesContainer = document.getElementById("selected-courses");

    document.getElementById("compare-container").addEventListener("dragover", function (event) {
        event.preventDefault();
    });
    
    document.getElementById("compare-container").addEventListener("drop", function (event) {
        event.preventDefault();
        let courseId = event.dataTransfer.getData("courseId");
        let courseName = event.dataTransfer.getData("courseName");
    
        if (courseId && !selectedCourses.includes(courseId)) {
            selectedCourses.push(courseId);
    
            let newElement = document.createElement("div");
            newElement.innerText = courseName;
            newElement.classList.add("selected-course");
    
            selectedCoursesContainer.appendChild(newElement);
        }
    });

    compareContainer.addEventListener("dragover", allowDrop);
    compareContainer.addEventListener("drop", drop);

    // Pass Laravel route dynamically from Blade
    var compareRoute = document.getElementById("compare-btn").getAttribute("data-route");

    // Compare button functionality
    document.getElementById("compare-btn").addEventListener("click", function () {
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
                    let courseCard = document.createElement('a');
                    courseCard.href = `courses/${course.id}`;
                    courseCard.classList.add('course-card-link');
                    courseCard.draggable = true; // Make draggable
                    courseCard.dataset.courseId = course.id; // Store course ID
                    courseCard.innerHTML = `
                        <div class="course-card" data-course-id="${course.id}">
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

                    coursesList.appendChild(courseCard);
                });

                // Reapply drag-and-drop after updating courses
                enableDragDrop();
            });
        });
    });
};
    

