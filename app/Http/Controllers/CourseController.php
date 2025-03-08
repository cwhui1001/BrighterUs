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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::with(['category', 'field', 'university', 'location', 'ranking'])->get();
            $fields = Field::all();
            $universities = University::all();
            $locations = Location::all();
            $categories = CourseCategory::all();
            $rankings = Ranking::all();

            $user = Auth::user();
            $courses->each(function ($course) use ($user) {
                $course->isBookmarked = $user ? $user->savedCourses()->where('course_id', $course->id)->exists() : false;
            });

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

        if ($request->has('other')) {
            $query->orWhere(function ($q) {
                $q->where('is_listed', 0);
            });
        }
    
        Log::info('Filter Query:', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);
    

        if ($request->has('location')) { 
            $query->whereIn('location_id', $request->location);
        }

        if ($request->has('budget')) {
            $query->where('budget', '<=', max($request->budget));
        }

        if ($request->has('ranking')) {
            $query->where('ranking_id', $request->ranking);
        }
        Log::info('Filter Query:', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);

        $courses = $query->paginate(100);
        $user = Auth::user();
        $courses->getCollection()->transform(function ($course) use ($user) {
            $course->isBookmarked = $user ? $user->savedCourses()->where('course_id', $course->id)->exists() : false;
            return $course;
        });
        return response()->json([
            'courses' => $courses,
            'isAuthenticated' => Auth::check(), // Use Auth facade
        ]);

        
    }


    public function compare(Request $request)
{
    $courseIds = $request->query('courses');

    if (!$courseIds) {
        return redirect()->back()->with('error', 'No courses selected for comparison.');
    }

    $courseIds = explode(',', $courseIds);

    // Validate course IDs
    if (empty($courseIds)) {
        return redirect()->back()->with('error', 'Invalid course IDs provided.');
    }

    $courses = Course::whereIn('id', $courseIds)->get();

    if ($courses->isEmpty()) {
        return redirect()->back()->with('error', 'No courses found with the provided IDs.');
    }

    return view('courses.compare', compact('courses'));
}


    
}

