<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EngraverEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The receipt object instance.
     *
     * @var Demo
     */
    public $plaque;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($plaque)
    {
        $this->plaque = $plaque;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('david@operation-braveheart.org.uk', 'Operation Braveheart')
            ->subject('OPeration Braveheart Plaque Engraving')
            ->view('email-templates.engraver-email')
            ->attachFromStorage('engraver/' . $plaque->order->orderid . '.pdf', [
                'as' => $plaque->order->orderid . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
