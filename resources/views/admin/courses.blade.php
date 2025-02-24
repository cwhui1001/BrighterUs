@vite(['resources/css/admin/courses.css', 'resources/js/admin/courses.js'])

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Course Management</h2><br>
    <!-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add New Course</button> -->

    <!-- Course Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Field</th>
                <th>University</th>
                <th>Location</th>
                <th>Budget</th>
                <th>Ranking</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->category->name }}</td>
                <td>{{ $course->field?->name ?? '-' }}</td>
                <td>{{ $course->university->name }}</td>
                <td>{{ $course->location->name }}</td>
                <td>{{ $course->budget }}</td>
                <td>{{ $course->ranking->value }}</td>
                <td><a href="{{ $course->link }}" target="_blank">View</a></td>
                <td>
                <button class="btn btn-warning btn-sm edit-course-btn"
                    data-id="{{ $course->id }}"
                    data-name="{{ $course->name ?? '' }}"
                    data-description="{{ $course->description ?? '' }}"
                    data-category-id="{{ $course->category->id ?? '' }}"
                    data-category-name="{{ $course->category->name ?? '' }}"
                    data-field-id="{{ $course->field?->id ?? '' }}"
                    data-field-name="{{ $course->field?->name ?? '' }}"
                    data-university-id="{{ $course->university->id ?? '' }}"
                    data-university-name="{{ $course->university->name ?? '' }}"
                    data-location-id="{{ $course->location->id ?? '' }}"
                    data-location-name="{{ $course->location->name ?? '' }}"
                    data-budget="{{ $course->budget ?? '' }}"
                    data-ranking-id="{{ $course->ranking->id ?? '' }}"
                    data-ranking-value="{{ $course->ranking->value ?? '' }}"
                    data-link="{{ $course->link ?? '' }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editCourseModal">
                    Edit
                </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include Add and Edit Course Modals -->
@include('admin.partials.add_course_modal')
@include('admin.partials.edit_course_modal')

@endsection
