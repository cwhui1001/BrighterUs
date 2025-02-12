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