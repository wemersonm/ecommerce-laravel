<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Mail\ResetPasswordMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     */
    private string $url;
    public function __construct(
        private User $user,
        private string|array $via,
        private string $hash,
    ) {
        $this->url = config('app.forgot_password') . 'email=' . $this->user->email . '&hash=' . $this->hash;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return is_array($this->via) ? $this->via : [$this->via];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return (new ResetPasswordMail($this->user->name, $this->url))->to($this->user);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
