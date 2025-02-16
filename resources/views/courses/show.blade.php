@vite(['resources/css/courses_show.css', 'resources/js/courses_show.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Courses and Universities') }}
        </h2>
    </x-slot>

    <div class="show-container">
        <div class="show-course-card">
            <h1 class="course-title">{{ $course->name }}</h1>

            <div class="course-details">
                <div class="detail-item">
                    <span class="label">Category:</span> {{ $course->category->name }}
                </div>
                <div class="detail-item">
                    <span class="label">Field:</span> {{ $course->field->name }}
                </div>
                <div class="detail-item">
                    <span class="label">University:</span> {{ $course->university->name }}
                </div>
                <div class="detail-item">
                    <span class="label">Location:</span> {{ $course->location->name }}
                </div>
                <div class="detail-item">
                    <span class="label">Budget:</span> {{ $course->budget }}
                </div>
                <div class="detail-item">
                    <span class="label">QS Ranking:</span> {{ $course->ranking->value }}
                </div>
            </div>

            <div class="description">
                <h3>Description</h3>
                <p>{{ $course->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
