@vite(['resources/css/courses.css', 'resources/js/courses.js'])
<!-- resources/views/courses/results.blade.php -->
@foreach($courses as $course)
    <div>
        <h3>{{ $course->name }}</h3>
        <p>Field: {{ $course->field->name }}</p>
        <p>University: {{ $course->university->name }}</p>
        <p>Location: {{ $course->location->name }}</p>
        <p>Budget: {{ $course->budget }}</p>
        <p>Ranking: {{ $course->ranking }}</p>
        <a href="{{ route('courses.show', $course->id) }}">View Details</a>
    </div>
@endforeach