<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendPlaqueToEngraver;
use App\Mail\EngraverEmail;
use App\Models\plaqueOrder;

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
    public function handle(SendPlaqueToEngraver $event)
    {
        try{
            \Mail::to('adrock952@gmail.com')->send(
                new EngraverEmail($event->plaque)
            );

            $plaqueOrder = plaqueOrder::where('id', $plaque->order->id)
                ->update([
                    'status' => 1
               ]);

        } catch(\Exception $e) {
            \Log::error($exception);
        }
        
    }
}
