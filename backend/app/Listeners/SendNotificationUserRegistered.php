<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendEmailRegisteredJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationUserRegistered
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        SendEmailRegisteredJob::dispatch($event->user);
    }
}
