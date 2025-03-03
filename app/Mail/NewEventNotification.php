<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class NewEventNotification extends Mailable
{
    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('New Event Notification')
                    ->view('emails.new_event')
                    ->with(['event' => $this->event]);
    }
}
