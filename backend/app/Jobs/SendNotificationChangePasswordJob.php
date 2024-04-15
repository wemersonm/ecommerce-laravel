<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ChangePasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationChangePasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $tries = 3;
    public $backoff = 3;
    public function __construct(
        private User $user,
        private string $token,
        private string|array $via
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new ChangePasswordNotification($this->via, $this->token));
    }
}
