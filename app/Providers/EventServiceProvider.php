<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SendPlaqueReceipt;
use App\Listeners\SendPlaqueConfirmationEmail;
use App\Events\SendContactFormAutoResponse;
use App\Listeners\SendContactFormAutoResponseEmail;
use App\Events\SendContactFormForwarder;
use App\Listeners\SendContactFormForwarderEmail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendPlaqueReceipt::class => [
            SendPlaqueConfirmationEmail::class
        ],
        SendContactFormAutoResponse::class => [
            SendContactFormAutoResponseEmail::class
        ],
        SendContactFormForwarder::class => [
            SendContactFormForwarderEmail::class
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
}
