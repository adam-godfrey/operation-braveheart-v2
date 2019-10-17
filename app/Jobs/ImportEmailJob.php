<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use Webklex\IMAP\Facades\Client;
use App\Models\Email;
use App\Models\EmailAttachment;

class ImportEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct () {
        // .. 
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $oClient = Client::account('default');
        $oClient->connect();
        $oClient->setDefaultAttachmentMask(CustomAttachmentMask::class);

        // $oFolder = $oClient->getFolder('INBOX.read');
        // $aMessage = $oFolder->messages()->all()->get();
        // get all unseen messages from folder INBOX
        $aMessage = $oClient->getUnseenMessages($oClient->getFolder('INBOX'));
 
        /** @var \Webklex\IMAP\Message $oMessage */
        foreach($aMessage as $oMessage){

            $email = new Email();

            $email->uid = $oMessage->getUid();
            $email->from = $oMessage->getFrom()[0]->mail;
            $email->subject = $oMessage->getSubject();
            $email->body = $oMessage->getHTMLBody(true);

            $email->save();      

            if($oMessage->getAttachments()->count() > 0) {

                $aAttachment = $oMessage->getAttachments();

                $aAttachment->each(function ($attachment) {
                    /** @var \Webklex\IMAP\Attachment $oAttachment */
                    $masked_attachment = $attachment->mask();

                    $masked_attachment->custom_save();
                });
            }
            
            // Move the current Message to 'INBOX.read'
            if($oMessage->moveToFolder('INBOX.read') == true){
                echo 'Message has been moved';
            }else{
                echo 'Message could not be moved';
            }
        }
    }
}

class CustomAttachmentMask extends \Webklex\IMAP\Support\Masks\AttachmentMask {
    /**
     * New custom method which can be called through a mask
     * @return string
     */
    public function token(){

        $token = implode('-', [$this->id, $this->getMessage()->getUid(), $this->name]);

        return $token;
    }
    /**
     * Custom attachment saving method
     * @return bool
     */
    public function custom_save() {
        $path = storage_path('app/attachments');
        $filename = $this->token();
        $path = substr($path, -1) == DIRECTORY_SEPARATOR ? $path : $path.DIRECTORY_SEPARATOR;

        $file =  File::put($path.$filename, $this->getContent()) !== false;

        $emailAttachment = new EmailAttachment();

        $emailAttachment->uid = $this->getMessage()->getUid();
        $emailAttachment->attachmentid = $this->id;
        $emailAttachment->filename = $filename = $this->token();
        $emailAttachment->original = $this->name;
        $emailAttachment->mime = \Storage::disk('attachments')->mimeType($filename);

        $emailAttachment->save();
    }
}
