<?php

namespace App\Providers;

use App\Events\ChangeEmail;
use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendNotificationChangeEmail;
use App\Listeners\SendNotificationForgotPassword;
use App\Listeners\SendNotificationUserRegistered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
            // Registered::class => [
            //     SendEmailVerificationNotification::class,
            // ],
        UserRegistered::class => [
            SendNotificationUserRegistered::class
        ],
        ForgotPassword::class => [
            SendNotificationForgotPassword::class,
        ],
        ChangeEmail::class => [
            SendNotificationChangeEmail::class,
        ]

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
