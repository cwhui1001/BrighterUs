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
        <label for="budget">Budget:</label>
        <input type="number" name="budget_min" placeholder="Min Budget">
        <input type="number" name="budget_max" placeholder="Max Budget">
    </div>

    <!-- Ranking Filter -->
    <div>
        <label for="ranking">Ranking:</label>
        <input type="number" name="ranking_min" placeholder="Min Ranking">
        <input type="number" name="ranking_max" placeholder="Max Ranking">
    </div>

    <button type="submit">Filter</button>
</form>