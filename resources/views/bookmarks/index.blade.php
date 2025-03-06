@vite(['resources/css/courses.css', 'resources/js/courses.js', 'resources/js/courses_show.js'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('My Bookmarks') }}
        </h2>
    </x-slot>

    <div class="py-12 courses-list">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($bookmarks as $course)
            <a href="{{ route('courses.show', $course->id) }}" class="course-card-link">
                <div class="course-card">
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
</x-app-layout>

<style>
    .courses-list .max-w-7xl {
    display: flex;
    flex-wrap: wrap; /* Allows cards to wrap if they don’t fit */
    gap: 20px; /* Space between cards */
    justify-content: center; /* Centers cards */
}

.course-card-link {
    flex: 1 1 calc(33.33% - 20px); /* Makes each card take up a third of the row */
    max-width: 35%; /* Prevents overflow */
    text-decoration: none;
}

</style>