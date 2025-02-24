<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Fetch all events
        return view('events', compact('events'));
        $request->validate([
            'image' => 'required|url'
        ]);
    }
    public function showEvent($id)
{
    $event = Event::find($id);

    if (!$event) {
        abort(404, 'Event not found');
    }

    // Convert to Malaysia Time (UTC+8)
    $start_time = \Carbon\Carbon::parse($event->start_time)->setTimezone('Asia/Kuala_Lumpur');
    $end_time = \Carbon\Carbon::parse($event->end_time)->setTimezone('Asia/Kuala_Lumpur');

    // Log the converted time for debugging
    \Log::info('Start Time (Malaysia Time): ' . $start_time);
    \Log::info('End Time (Malaysia Time): ' . $end_time);

    // Generate Google Calendar Link
    $googleCalendarLink = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=" . urlencode($event->title) .
        "&dates=" . $start_time->format('Ymd\THis\Z') . "/" . $end_time->format('Ymd\THis\Z') .
        "&details=" . urlencode($event->description) .
        "&location=" . urlencode($event->location);

    return view('event.show', compact('event', 'googleCalendarLink'));
}
}
