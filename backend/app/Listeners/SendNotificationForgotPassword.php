<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Jobs\SendEmailResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationForgotPassword
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(ForgotPassword $event): void
    {
        SendEmailResetPassword::dispatch($event->user, $event->token);
    }
}
