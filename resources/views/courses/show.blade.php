@vite(['resources/css/courses.css', 'resources/js/courses.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Couses and Universities') }}
        </h2>
    </x-slot>

<!-- resources/views/courses/show.blade.php -->
<p>Category: {{ $course->category->name }}</p>
<h1>{{ $course->name }}</h1>
<p>Field: {{ $course->field->name }}</p>
<p>University: {{ $course->university->name }}</p>
<p>Location: {{ $course->location->name }}</p>
<p>Budget: {{ $course->budget }}</p>
<p>Ranking: {{ $course->ranking }}</p>
<p>Description: {{ $course->description }}</p><br>


</x-app-layout>
