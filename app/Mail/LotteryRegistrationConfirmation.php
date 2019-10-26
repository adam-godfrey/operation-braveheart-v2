<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LotteryRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The receipt object instance.
     *
     * @var Demo
     */
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@operation-braveheart.org.uk', 'Operation Braveheart')
            ->subject('Operation Braveheart Lotter Registration')
            ->view('email-templates.lottery-confirmation');
    }
}
