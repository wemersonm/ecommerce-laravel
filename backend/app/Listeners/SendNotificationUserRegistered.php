<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendEmailRegisteredJob;
use App\Mail\UserRegisteredEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationUserRegistered implements ShouldQueue
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
