@vite(['resources/css/courses_show.css', 'resources/js/courses_show.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Compare Courses') }}
        </h2>
    </x-slot>

    <div class="compare-container">
        @foreach ($courses as $course)
            <div class="course-item">
                <x-course-details :course="$course" />
            </div>
        @endforeach
    </div>
    <script src="{{ asset('js/courses_show.js') }}"></script>
    <script src="{{ asset('js/courses.js') }}"></script>


</x-app-layout>

