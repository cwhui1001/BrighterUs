<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Field;
use App\Models\University;
use App\Models\Location;
use App\Models\CourseCategory;
use App\Models\Ranking;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::with(['category', 'field', 'university', 'location', 'ranking'])->paginate(10);
            $fields = Field::all();
            $universities = University::all();
            $locations = Location::all();
            $categories = CourseCategory::all();
            $rankings = Ranking::all();

            return view('courses.index', compact('courses', 'fields', 'universities', 'locations', 'categories', 'rankings'));
        } catch (Exception $e) {
            return back()->with('error', 'An error occurred while fetching the courses.');
        }
    }

    public function show($id)
    {
        try {
            $course = Course::with('category')->findOrFail($id);
            return view('courses.show', compact('course'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        } catch (Exception $e) {
            return back()->with('error', 'An error occurred while fetching the course details.');
        }
    }

    public function filter(Request $request)
{
    $query = Course::with(['category', 'field', 'university', 'location', 'ranking']);

    // Apply search filter
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'LIKE', "%{$search}%")
              ->orWhereHas('category', function ($q) use ($search) {
                  $q->where('name', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('field', function ($q) use ($search) {
                  $q->where('name', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('university', function ($q) use ($search) {
                  $q->where('name', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('location', function ($q) use ($search) {
                  $q->where('name', 'LIKE', "%{$search}%");
              });
    }
    
    if ($request->has('category')) {
        $query->whereIn('category_id', $request->category);
    }

    if ($request->has('field')) {
        $query->whereIn('field_id', $request->field);
    }

    if ($request->has('university')) {
        $query->whereIn('university_id', $request->university);
    }

    if ($request->has('location')) {
        $query->whereIn('location_id', $request->location);
    }

    if ($request->has('budget')) {
        $query->where('budget', '<=', max($request->budget));
    }

    if ($request->has('ranking')) {
        $query->where('ranking_id', $request->ranking);
    }

    $courses = $query->paginate(10);

    return response()->json(['courses' => $courses]);
}

public function compare(Request $request)
{
    $selectedIds = explode(',', $request->query('courses'));
    $courses = Course::whereIn('id', $selectedIds)->get();
    
    return view('courses.compare', compact('courses'));
}

}

