<?php

namespace App\Jobs;

use App\Mail\ChangeEmailMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailChangeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private $user,
        private string $token,

    ) {

    }
    public $tries = 3;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new ChangeEmailMail($this->user, $this->token));
    }
}
