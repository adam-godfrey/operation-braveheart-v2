<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendLotteryRegistrationConfirmationAdmin;
use App\Mail\LotteryRegistrationConfirmatioAdmin;

class SendLotteryRegistrationConfirmationAdminEmail
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
    public function handle(SendLotteryRegistrationConfirmationAdmin $event)
    {
        \Mail::to('david@operation-braveheart.org.uk')->send(
            new LotteryRegistrationConfirmationAdmin($event->player)
        );
    }
}
