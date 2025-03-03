@extends('layouts.admin')

@section('content')
<h2 style="background-color: orange; padding: 20px; color: white; border-radius: 15px">Edit Course</h2>

<div class="py-12">
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" style="padding: 30px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $course->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="field_id" class="form-label">Field</label>
            <select name="field_id" id="field_id" class="form-select">
                <option value="">Select Field (Optional)</option>
                @foreach($fields as $field)
                    <option value="{{ $field->id }}" {{ $course->field_id == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="university_id" class="form-label">University</label>
            <select name="university_id" id="university_id" class="form-select" required>
                <option value="">Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ $course->university_id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="location_id" class="form-label">Location</label>
            <select name="location_id" id="location_id" class="form-select" required>
                <option value="">Select Location</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ $course->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="budget" class="form-label">Budget</label>
            <input type="number" name="budget" id="budget" class="form-control" value="{{ $course->budget }}">
        </div>
        <div class="mb-3">
            <label for="ranking_id" class="form-label">Ranking</label>
            <select name="ranking_id" id="ranking_id" class="form-select">
                <option value="">Select Ranking (Optional)</option>
                @foreach($rankings as $ranking)
                    <option value="{{ $ranking->id }}" {{ $course->ranking_id == $ranking->id ? 'selected' : '' }}>{{ $ranking->value }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ $course->link }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection