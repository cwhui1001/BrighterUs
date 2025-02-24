<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
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
