<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendLotteryRegistrationConfirmation;
use App\Mail\LotteryRegistrationConfirmation;

class SendLotteryRegistrationConfirmationEmail
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
    public function handle(SendLotteryRegistrationConfirmation $event)
    {
        \Mail::to($event->player->email)->send(
            new LotteryRegistrationConfirmation($event->player)
        );
    }
}
