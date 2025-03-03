<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewEventAdded
{
    use Dispatchable, SerializesModels;

    public $event;
    public $email;

    public function __construct($event, $email)
    {
        $this->event = $event;
        $this->email = $email;
    }
}
