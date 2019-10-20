<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendContactFormForwarder;
use App\Mail\ContactFormForwarder;

class SendContactFormForwarderEmail
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
    public function handle(SendContactFormForwarder $event)
    {
        \Mail::to('david@operation-braveheart.org.uk')->send(
            new ContactFormForwarder($event->contact)
        );
    }
}
