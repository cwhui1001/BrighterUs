<?php

namespace App\Listeners;

use App\Events\NewEventAdded;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewEventNotification;

class SendEventNotification
{
    public function handle(NewEventAdded $event)
    {
        // Send email to the correct user
        Mail::to($event->email)->send(new NewEventNotification($event->event));
    }
}
