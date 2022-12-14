<?php

namespace App\Providers;

use App\Events as AppEvents;
use App\Listeners as AppListeners;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        AppEvents\FailedAction::class => [
            AppListeners\SendFailedActionNotification::class,
        ],

        AppEvents\Product\StoredSuccessful::class => [
            AppListeners\Product\SendStoredSuccessfulNotification::class,
        ],

        'Illuminate\Auth\Events\Registered' => [
            SendEmailVerificationNotification::class,
            AppListeners\AuthActivityLog::class.'@registered',
        ],

        'Illuminate\Auth\Events\Attempting' => [
            AppListeners\AuthActivityLog::class.'@attempting',
        ],

        // 'Illuminate\Auth\Events\Authenticated' => [
        //     AppListeners\AuthActivityLog::class.'@authenticated',
        // ],

        'Illuminate\Auth\Events\Login' => [
            AppListeners\AuthActivityLog::class.'@login',
        ],

        'Illuminate\Auth\Events\Failed' => [
            AppListeners\AuthActivityLog::class.'@failed',
        ],

        'Illuminate\Auth\Events\Validated' => [
            AppListeners\AuthActivityLog::class.'@validated',
        ],

        'Illuminate\Auth\Events\Verified' => [
            AppListeners\AuthActivityLog::class.'@verified',
        ],

        'Illuminate\Auth\Events\Logout' => [
            AppListeners\AuthActivityLog::class.'@logout',
        ],

        'Illuminate\Auth\Events\CurrentDeviceLogout' => [
            AppListeners\AuthActivityLog::class.'@currentDeviceLogout',
        ],

        'Illuminate\Auth\Events\OtherDeviceLogout' => [
            AppListeners\AuthActivityLog::class.'@otherDeviceLogout',
        ],

        'Illuminate\Auth\Events\Lockout' => [
            AppListeners\AuthActivityLog::class.'@lockout',
        ],

        'Illuminate\Auth\Events\PasswordReset' => [
            AppListeners\AuthActivityLog::class.'@passwordreset',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
