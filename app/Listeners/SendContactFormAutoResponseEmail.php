<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendContactFormAutoResponse;
use App\Mail\ContactFormAutoResponse;

class SendContactFormAutoResponseEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendPlaqueReceipt  $event
     * @return void
     */
    public function handle(SendContactFormAutoResponse $event)
    {
        \Mail::to($event->contact->email)->send(
            new ContactFormAutoResponse($event->contact)
        );
    }
}
