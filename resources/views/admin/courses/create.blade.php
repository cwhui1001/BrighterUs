@extends('layouts.admin')

@section('content')
<div class="admin-header-container">
    <h1>Create New Course</h1>
</div>

<div class="py-12">
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="field_id" class="form-label">Field</label>
            <select name="field_id" id="field_id" class="form-select">
                <option value="">Select Field (Optional)</option>
                @foreach($fields as $field)
                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="university_id" class="form-label">University</label>
            <select name="university_id" id="university_id" class="form-select" required>
                <option value="">Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="location_id" class="form-label">Location</label>
            <select name="location_id" id="location_id" class="form-select" required>
                <option value="">Select Location</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="budget" class="form-label">Budget</label>
            <input type="number" name="budget" id="budget" class="form-control">
        </div>
        <div class="mb-3">
            <label for="ranking_id" class="form-label">Ranking</label>
            <select name="ranking_id" id="ranking_id" class="form-select">
                <option value="">Select Ranking (Optional)</option>
                @foreach($rankings as $ranking)
                    <option value="{{ $ranking->id }}">{{ $ranking->value }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" name="link" id="link" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>
</div>
@endsection