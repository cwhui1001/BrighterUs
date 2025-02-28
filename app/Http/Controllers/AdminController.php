<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->checkAdmin();
    }

    protected function checkAdmin()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalEvents = Event::count();

        $userData = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();

        $courseData = Course::join('universities', 'courses.university_id', '=', 'universities.id')
            ->selectRaw('universities.name as university, DATE(courses.created_at) as date, COUNT(*) as count')
            ->groupBy('universities.name', 'date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();

        $eventData = Event::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();

        // Now return the view with all data
        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalEvents', 'userData', 'courseData', 'eventData'));
    }


    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a consistent file name, e.g. user_5.jpg
        $filename = 'user_' . Auth::id() . '.jpg';

        // Store it in the profile_photos folder within storage/app/public
        $request->file('profile_photo')->storeAs('profile_photos', $filename, 'public');

        return redirect()->route('admin.dashboard')->with('success', 'Profile photo updated successfully!');
    }




    public function users(Request $request)
    {
        // Start building the query
        $query = User::query();

        // Apply filters
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('email') && $request->email != '') {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Fetch filtered users
        $users = $query->get();

        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function getChartData()
{
    // Fetch user registration count per month
    $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $courses = Course::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $events = Event::selectRaw('type, COUNT(*) as count')
        ->groupBy('type')
        ->get();

    return response()->json([
        'users' => [
            'labels' => $users->pluck('month')->map(fn($m) => date("F", mktime(0, 0, 0, $m, 1))),
            'counts' => $users->pluck('count'),
        ],
        'courses' => [
            'labels' => $courses->pluck('month')->map(fn($m) => date("F", mktime(0, 0, 0, $m, 1))),
            'counts' => $courses->pluck('count'),
        ],
        'events' => [
            'labels' => $events->pluck('type'),
            'counts' => $events->pluck('count'),
        ]
    ]);
}






}