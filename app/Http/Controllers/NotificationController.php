<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = DatabaseNotification::find($id);
        if ($notification) {
            $notification->markAsRead(); // Laravel's built-in function
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Notification not found.'], 404);
    }
}