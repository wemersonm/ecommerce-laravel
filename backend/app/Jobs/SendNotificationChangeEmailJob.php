<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\ChangeEmailNotification;

class SendNotificationChangeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 3;
    /**
     * Create a new job instance.
     */
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
        try {
            $this->user->notify(new ChangeEmailNotification($this->via, $this->token));
        } catch (\Exception $e) {
            Log::info('Jobs/' . class_basename($this) . $e->getMessage());
        }
    }
}
