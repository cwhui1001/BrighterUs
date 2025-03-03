<?php

namespace App\Http\Controllers;
use App\Models\User;  // Ensure you import the User model
use App\Events\NewEventAdded;
use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|url',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'map_location' => 'required',
            'website' => 'required|url',
        ]);

        // Create event in the database
        $event = Event::create($request->all());

        // Fetch all users who should receive the email (modify if necessary)
        $users = User::where('is_admin', 0)->get(); // Only admin users


        foreach ($users as $user) {
            event(new NewEventAdded($event, $user->email));
        }

        return redirect()->route('admin.events')->with('success', 'Event added successfully.');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|url',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'map_location' => 'required',
            'website' => 'required|url',
        ]);

        $event->update($validatedData);

        return redirect()->route('admin.events')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
{
    $event = Event::find($id);

    if (!$event) {
        return redirect()->back()->with('error', 'Event not found.');
    }

    $event->delete();

    return redirect()->back()->with('success', 'Event deleted successfully.');
}
}