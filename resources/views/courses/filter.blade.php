@vite(['resources/css/courses.css', 'resources/js/courses.js'])
<!-- resources/views/courses/filter.blade.php -->
<form action="{{ route('courses.filter') }}" method="GET">
    
    <div>
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <!-- Field Filter -->
    <div>
        <label for="field">Field:</label>
        <select name="field" id="field">
            <option value="">All Fields</option>
            @foreach($fields as $field)
                <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- University Filter -->
    <div>
        <label for="university">University:</label>
        <select name="university" id="university">
            <option value="">All Universities</option>
            @foreach($universities as $university)
                <option value="{{ $university->id }}">{{ $university->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Location Filter -->
    <div>
        <label for="location">Location:</label>
        <select name="location" id="location">
            <option value="">All Locations</option>
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Budget Filter -->
    <div>
        <h4>Budget</h4>
        <label for="budget-min">Min Budget:</label>
        <input type="range" id="budget-min" name="budget_min" min="0" max="20000" step="1000" value="0">
        <span id="budget-min-value">RM 0</span>

        <label for="budget-max">Max Budget:</label>
        <input type="range" id="budget-max" name="budget_max" min="0" max="20000" step="1000" value="20000">
        <span id="budget-max-value">RM 20000</span>
    </div>

    <!-- Ranking Filter -->
    <div>
        <h4>Ranking</h4>
        <label for="ranking-min">Min Ranking:</label>
        <input type="range" id="ranking-min" name="ranking_min" min="0" max="100" step="1" value="0">
        <span id="ranking-min-value">0</span>

        <label for="ranking-max">Max Ranking:</label>
        <input type="range" id="ranking-max" name="ranking_max" min="0" max="100" step="1" value="100">
        <span id="ranking-max-value">100</span>
    </div>

    <button type="submit">Filter</button>
</form> 