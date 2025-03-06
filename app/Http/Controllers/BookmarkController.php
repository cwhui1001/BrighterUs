<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\User;


class BookmarkController extends Controller
{
    public function toggleBookmark(Request $request, Course $course)
    {
        $user = Auth::user();

        if ($user->savedCourses()->where('course_id', $course->id)->exists()) {
            $user->savedCourses()->detach($course->id);
            return response()->json(['status' => 'removed']);
        } else {
            $user->savedCourses()->attach($course->id);
            return response()->json(['status' => 'added']);
        }
    }

    public function index()
    {
        $user = Auth::user();
        $bookmarks = $user->savedCourses()->with('university', 'category', 'field', 'location', 'ranking')->get();
        return view('bookmarks.index', compact('bookmarks'));
    }
}