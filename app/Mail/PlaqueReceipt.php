<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlaqueReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The receipt object instance.
     *
     * @var Demo
     */
    public $receipt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('memorialgarden@operation-braveheart')
                    ->subject('Operation Braveheart Memorial Garden Plaque Receipt')
                    ->view('email-templates.order-confirmation');
    }
}
