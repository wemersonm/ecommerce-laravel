<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Bus\Queueable;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNotificationResetPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user,
        private string $token,
        private string|array $via,
    ) {
        
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->user->notify(new ResetPasswordNotification($this->user, $this->via, $this->token));
        } catch (\Exception $e) {
            Log::info('Jobs/' . class_basename($this) . $e->getMessage());
        }
    }
}
