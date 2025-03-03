@vite(['resources/css/courses_show.css', 'resources/js/courses_show.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Compare Courses') }}
        </h2>
    </x-slot>

    <div class="compare-container">
        @foreach ($courses as $course)
        <div class="course-item" id="course-{{ $course->id }}" data-course-id="{{ $course->id }}">
            <button class="close-btn">X</button>
            <x-course-details :course="$course" />
        </div>

        @endforeach
    </div>
    <script src="{{ asset('js/courses_show.js') }}"></script>
    <script src="{{ asset('js/courses.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".close-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const courseElement = this.closest(".course-item");
                    if (courseElement) {
                        courseElement.remove();
                    }
                });
            });
        });

    </script>

</x-app-layout>

