<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Field;
use App\Models\University;
use App\Models\Location;
use App\Models\Ranking;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        // Fetch filter options
        $categories = CourseCategory::all();
        $fields = Field::all();
        $universities = University::all();
        $locations = Location::all();
        $rankings = Ranking::all();

        // Start building the query
        $query = Course::query();

        // Apply filters
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('field_id') && $request->field_id != '') {
            $query->where('field_id', $request->field_id);
        }

        if ($request->has('university_id') && $request->university_id != '') {
            $query->where('university_id', $request->university_id);
        }

        if ($request->has('location_id') && $request->location_id != '') {
            $query->where('location_id', $request->location_id);
        }

        if ($request->has('min_budget') && $request->min_budget != '') {
            $query->where('budget', '>=', $request->min_budget);
        }

        if ($request->has('max_budget') && $request->max_budget != '') {
            $query->where('budget', '<=', $request->max_budget);
        }

        if ($request->has('ranking_id') && $request->ranking_id != '') {
            $query->where('ranking_id', $request->ranking_id);
        }

        // Fetch filtered courses
        $courses = $query->get();

        return view('admin.courses', compact('courses', 'categories', 'fields', 'universities', 'locations', 'rankings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'field_id' => 'nullable|integer',
            'university_id' => 'required|integer',
            'location_id' => 'required|integer',
            'budget' => 'required|integer',
            'ranking_id' => 'required|integer',
            'description' => 'nullable|string',
            'link' => 'required|url',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses')->with('success', 'Course added successfully.');
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'field_id' => 'required|integer',
            'university_id' => 'required|integer',
            'location_id' => 'required|integer',
            'budget' => 'required|numeric',
            'ranking_id' => 'required|integer',
            'description' => 'required|string',
            'link' => 'required|url',
        ]);

        $course->update($validatedData);

        return redirect()->route('admin.courses')->with('success', 'Course updated successfully');
    }
}