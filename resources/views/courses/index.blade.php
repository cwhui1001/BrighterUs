@vite(['resources/css/courses.css', 'resources/js/courses.js', 'resources/js/courses_show.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Courses & Universities') }}
            <input type="text" id="filterSearch" class="search-bar" placeholder="Search for courses, universities, or fields...">

        </h2>
    </x-slot>

    <!-- Main Content --> 
    <div class="course-container">
        <!-- Filter Panel -->
        <button id="toggle-filters-btn" class="toggle-filters-btn">⮜</button>
            <div class="filter-panel p-5 bg-light rounded">             
                <form id="filter-form">
                    <h4>Category</h4>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" name="category[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                            <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach

                    <h4>Field</h4>
                    @foreach ($fields as $field)
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" name="field[]" value="{{ $field->id }}" id="field{{ $field->id }}">
                            <label class="form-check-label" for="field{{ $field->id }}">{{ $field->name }}</label>
                        </div>
                    @endforeach

                    <h4>Universities & Colleges</h4>
                    @foreach ($universities as $university)
                        @if ($university->is_listed) <!-- Or use a predefined list -->
                            <div class="form-check">
                                <input class="form-check-input filter-checkbox" type="checkbox" name="university[]" value="{{ $university->id }}" id="university{{ $university->id }}">
                                <label class="form-check-label" for="university{{ $university->id }}">{{ $university->name }}</label>
                            </div>
                        @endif
                    @endforeach
                    <!-- Add the "Other" option -->
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="university[]" value="other" id="universityOther">
                        <label class="form-check-label" for="universityOther">Other</label>
                    </div>

                    <h4>Location</h4>
                    @foreach ($locations as $location)
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" name="location[]" value="{{ $location->id }}" id="location{{ $location->id }}">
                            <label class="form-check-label" for="location{{ $location->id }}">{{ $location->name }}</label>
                        </div>
                    @endforeach

                    <h4>Budget</h4>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="5000" id="budget5000">
                        <label class="form-check-label" for="budget5000">Below RM 5000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="10000" id="budget10000">
                        <label class="form-check-label" for="budget10000">Below RM 10000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="20000" id="budget20000">
                        <label class="form-check-label" for="budget20000">Below RM 20000</label>
                    </div>

                    <h4>Ranking</h4>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="ranking[]" value="10" id="ranking10">
                        <label class="form-check-label" for="ranking10">Top 10</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="ranking[]" value="50" id="ranking50">
                        <label class="form-check-label" for="ranking50">Top 50</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="ranking[]" value="100" id="ranking100">
                        <label class="form-check-label" for="ranking100">Top 100</label>
                    </div>
                </form>
            </div>
       
        <!-- Results Section -->
        <div class="results">
            <br><h1 class="results-title">Results</h1>
            <br>

           

            <div id="compare-container" class="compare-box" ondrop="drop(event)" ondragover="allowDrop(event)">
                <h2>Compare Courses</h2>
                <div id="selected-courses">
                    <p id="placeholder-text">Drag and drop courses here to compare</p>
                </div>
                <div class="button-group">
                    <button id="compare-btn" data-route="{{ route('courses.compare') }}" onclick="redirectToCompare()">Compare</button>
                    <button id="clear-btn" onclick="clearCompareBox()">Clear</button>
                </div>
            </div>


          

            <div id="courses-list">
            @foreach ($courses as $course)
            
            <a id="course-{{ $course->id }}" href="{{ route('courses.show', $course->id) }}" 
                class="course-card-link" draggable="true" 
                data-course-id="{{ $course->id }}" 
                ondragstart="event.dataTransfer.setData('text', this.id)">

                <div class="course-card" draggable="true" data-course-id="{{ $course->id }}" ondragstart="drag(event)">
                    <h5 class="course-title">{{ $course->name }}</h5>
                    <hr>
                    <div class="c2">
                        <img src="{{ $course->university->logo }}">
                        <div>
                            <p><strong>Category:</strong> {{ $course->category->name }}</p>
                            <p><strong>Field:</strong> {{ $course->field?->name ?? '-' }}</p>
                            <p><strong>University:</strong> {{ $course->university->name }}</p>
                            <p><strong>QS Ranking:</strong> {{ $course->ranking->value }}</p>
                        </div>
                    </div>
                    <div class="c3">
                        <p><strong>Budget:</strong><br> RM {{ number_format($course->budget, 0) }}</p>
                        <p><strong>Location:</strong><br> {{ is_object($course->location) ? $course->location->name : $course->location }}</p>
                    </div>
                </div>
            </a>

            @endforeach
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.filter-checkbox, #filterSearch').forEach(input => {
    input.addEventListener('input', function () {
        let form = document.getElementById('filter-form');
        let formData = new FormData();

        // Track selected universities
        let selectedUniversities = [];

        // Add all checked checkboxes to the form data
        form.querySelectorAll('input[type="checkbox"]:checked').forEach((checkbox) => {
            if (checkbox.name === "university[]") {
                selectedUniversities.push(checkbox.value); // Track selected universities
            }
            formData.append(checkbox.name + "[]", checkbox.value);
        });

        // Check if "Other" is selected
        let isOtherSelected = selectedUniversities.includes("other");

        // If "Other" is selected, ensure the backend knows to filter by is_listed = 0
        if (isOtherSelected) {
            formData.append('is_other', 'true'); // Add a flag for "Other"
        }

        // Add the search query to the form data
        let searchQuery = document.getElementById('filterSearch').value;
        if (searchQuery.trim() !== '') {
            formData.append('search', searchQuery);
        }

        // Convert form data to a query string
        let query = new URLSearchParams(formData).toString();

        // Send the filter request to the backend
        fetch("{{ route('courses.filter') }}?" + query, {
            method: "GET",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            let coursesList = document.getElementById('courses-list');
            coursesList.innerHTML = ""; // Clear existing content

            // Loop through the filtered courses and create course cards
            data.courses.data.forEach(course => {
                let courseCard = document.createElement('a');
                courseCard.href = `courses/${course.id}`;
                courseCard.classList.add('course-card-link');
                courseCard.draggable = true; // Make draggable
                courseCard.dataset.courseId = course.id; // Store course ID
                courseCard.innerHTML = `
                    <div class="course-card">
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

</script>


</x-app-layout>

