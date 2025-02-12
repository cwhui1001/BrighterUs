@vite(['resources/css/courses.css', 'resources/js/courses.js'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Courses & Universities') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="container">
        <!-- Filter Panel -->
        <div class="col-md-3">
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

                    <h4>University</h4>
                    @foreach ($universities as $university)
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" name="university[]" value="{{ $university->id }}" id="university{{ $university->id }}">
                            <label class="form-check-label" for="university{{ $university->id }}">{{ $university->name }}</label>
                        </div>
                    @endforeach

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
                        <label class="form-check-label" for="budget5000">Below $5000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="10000" id="budget10000">
                        <label class="form-check-label" for="budget10000">Below $10000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="20000" id="budget20000">
                        <label class="form-check-label" for="budget20000">Below $20000</label>
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
        </div>
                
        <!-- Results Section -->
        <div class="col-md-9">
            <br><h1 class="results-title">Results</h1><br>
            <div id="courses-list">
                @foreach ($courses as $course)
                <div class="course-card">
                    <h5 class="course-title">
                        <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                    </h5>
                    <hr>
                    <p><strong>Category:</strong> {{ $course->category->name }}</p>
                    <p><strong>Field:</strong> {{ $course->field->name }}</p>
                    <p><strong>University:</strong> {{ $course->university->name }}</p>
                    <p><strong>Location:</strong> {{ is_object($course->location) ? $course->location->name : $course->location }}</p>
                    <p><strong>Budget:</strong> ${{ number_format($course->budget, 2) }}</p>
                    <p><strong>Ranking:</strong> {{ $course->ranking }}</p>
                    <p class="course-description"><strong>Description:</strong> {{ $course->description }}</p>
                </div>
                @endforeach
            </div>
                
            <!-- Pagination -->
            <div class="pagination-container">
                {{ $courses->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let form = document.getElementById('filter-form');
                let formData = new FormData();

                form.querySelectorAll('input[type="checkbox"]:checked').forEach((checkbox) => {
                    formData.append(checkbox.name + "[]", checkbox.value);
                });


                let query = new URLSearchParams(formData).toString();

                fetch("{{ route('courses.filter') }}?" + query, {
                    method: "GET",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    let coursesList = document.getElementById('courses-list');
                    coursesList.innerHTML = "";

                    data.courses.data.forEach(course => {
                        let courseCard = document.createElement('div');
                        courseCard.classList.add('course-card');

                        courseCard.innerHTML = `
                            <h5 class="course-title">
                                <a href="/courses/${course.id}">${course.name}</a>
                            </h5>
                            <hr>
                            <p><strong>Category:</strong> ${course.category ? course.category.name : 'N/A'}</p>
                            <p><strong>Field:</strong> ${course.field ? course.field.name : 'N/A'}</p>
                            <p><strong>University:</strong> ${course.university ? course.university.name : 'N/A'}</p>
                            <p><strong>Location:</strong> ${course.location ? course.location.name : 'N/A'}</p>
                            <p><strong>Budget:</strong> $${course.budget.toLocaleString()}</p>
                            <p><strong>Ranking:</strong> ${course.ranking}</p>
                            <p class="course-description"><strong>Description:</strong> ${course.description}</p>
                        `;

                        coursesList.appendChild(courseCard);
                    });
                })
                
            });
        });

        
    </script>
    
</x-app-layout>