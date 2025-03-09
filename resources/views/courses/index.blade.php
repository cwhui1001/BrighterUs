@vite(['resources/css/courses.css', 'resources/js/courses.js', 'resources/js/courses_show.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="30000" id="budget30000">
                        <label class="form-check-label" for="budget30000">Below RM 30000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="50000" id="budget50000">
                        <label class="form-check-label" for="budget50000">Below RM 50000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="100000" id="budget100000">
                        <label class="form-check-label" for="budget100000">Below RM 100000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="budget[]" value="200000" id="budget200000">
                        <label class="form-check-label" for="budget200000">Below RM 200000</label>
                    </div>

                    <h4>Ranking</h4>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="ranking[]" value="100" id="ranking100">
                        <label class="form-check-label" for="ranking100">Top 100</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="ranking[]" value="500" id="ranking500">
                        <label class="form-check-label" for="ranking500">Top 500</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" name="ranking[]" value="1200" id="ranking1200">
                        <label class="form-check-label" for="ranking1200">Top 1200</label>
                    </div>
                </form>
            </div>
       
        <!-- Results Section --> 
        <div class="results">
            <br><h1 class="results-title">Results</h1>
            <br>
            <div id="compare-container" class="compare-box">
                <h2>Compare Courses</h2>
                <div id="selected-courses">
                    <p id="placeholder-text">Drag and drop courses here to compare</p>
                </div>
                <div class="button-group">
                    <button id="compare-btn" data-route="{{ route('courses.compare') }}" onclick="redirectToCompare()">Compare</button>
                    <button id="clear-btn" onclick="clearCompareBox()">Clear</button>
                </div>
            </div>

            <!-- Toggle Button (Always Visible) -->
            <button id="toggle-compare-btn" class="toggle-btn">-</button>


            <div id="courses-list">
                @foreach ($courses as $course)
                <div class="course-card-container" data-course-id="{{ $course->id }}">
                    <!-- Bookmark Button -->
                    @auth
                        <button class="bookmark-btn"
                                data-course-id="{{ $course->id }}"
                                data-logged-in="true"
                                onclick="toggleBookmark(this)">
                            <i class="{{ $course->isBookmarked ? 'fas' : 'far' }} fa-bookmark"></i>
                        </button>
                    @else
                        <button class="bookmark-btn"
                                data-course-id="{{ $course->id }}"
                                data-logged-in="false"
                                onclick="toggleBookmark(this)">
                            <i class="far fa-bookmark"></i>
                        </button>
                    @endauth

                    <!-- Course Card Content -->
                    <div class="course-card" draggable="true" data-course-id="{{ $course->id }}" data-course-url="{{ route('courses.show', $course->id) }}">
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
                </div>
                @endforeach
            </div>
        </div>
    </div>

    

</x-app-layout>

