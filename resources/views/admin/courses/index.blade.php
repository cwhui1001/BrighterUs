@vite(['resources/css/admin/courses.css', 'resources/js/admin/courses.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.admin')

@section('content')
<div class="admin-header-container">
    <h1>Course Management</h1>
</div>

<div class="py-12">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Course Button -->
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Add Course</a>

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.courses.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="field_id">Field</label>
                        <select name="field_id" id="field_id" class="form-control">
                            <option value="">All Fields</option>
                            @foreach($fields as $field)
                                <option value="{{ $field->id }}" {{ request('field_id') == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="university_id">University</label>
                        <select name="university_id" id="university_id" class="form-control">
                            <option value="">All Universities</option>
                            @foreach($universities as $university)
                                <option value="{{ $university->id }}" {{ request('university_id') == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="location_id">Location</label>
                        <select name="location_id" id="location_id" class="form-control">
                            <option value="">All Locations</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="min_budget">Min Budget</label>
                        <input type="number" name="min_budget" id="min_budget" class="form-control" value="{{ request('min_budget') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="max_budget">Max Budget</label>
                        <input type="number" name="max_budget" id="max_budget" class="form-control" value="{{ request('max_budget') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="ranking_id">Ranking</label>
                        <select name="ranking_id" id="ranking_id" class="form-control">
                            <option value="">All Rankings</option>
                            @foreach($rankings as $ranking)
                                <option value="{{ $ranking->id }}" {{ request('ranking_id') == $ranking->id ? 'selected' : '' }}>{{ $ranking->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
     
    <!-- Course Table -->
    <table class="course-table table-bordered">
        <thead>
            <tr>
                <th>Actions</th>
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
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm edit">Edit</a><br><br>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this course?')">Delete</button>
                    </form>
                </td>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
