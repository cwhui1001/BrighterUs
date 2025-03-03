@vite(['resources/css/courses_show.css', 'resources/js/courses_show.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Courses and Universities') }}
        </h2>
    </x-slot>

    <div class="show-container">
        <x-course-details :course="$course" />
    </div>
</x-app-layout>