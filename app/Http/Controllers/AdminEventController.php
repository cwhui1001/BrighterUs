<?php

namespace App\Http\Controllers;

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

        Event::create($request->all());

        return redirect()->route('admin.events')->with('success', 'Event added successfully.');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

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

        $event->update($request->all());

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
