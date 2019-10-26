<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendPlaqueReceipt;
use App\Mail\PlaqueReceipt;

class SendPlaqueConfirmationEmail
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
    public function handle(SendPlaqueReceipt $event)
    {
        \Mail::to($event->receipt->email)->send(
            new PlaqueReceipt($event->receipt)
        );
    }
}
