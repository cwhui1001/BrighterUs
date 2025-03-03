<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewEventAdded;
use App\Listeners\SendEventNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        NewEventAdded::class => [
            SendEventNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
