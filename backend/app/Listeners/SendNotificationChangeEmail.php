<?php

namespace App\Listeners;

use App\Events\ChangeEmail;
use App\Jobs\SendEmailChangeEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationChangeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(
    ) {

    }

    /**
     * Handle the event.
     */
    public function handle(ChangeEmail $event): void
    {
        SendEmailChangeEmailJob::dispatch($event->user, $event->token);
    }
}
