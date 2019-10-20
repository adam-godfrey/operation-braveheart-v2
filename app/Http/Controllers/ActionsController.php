<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Event;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Events\SendPlaqueReceipt;
use App\Models\Plaque;
use App\Models\Admin\LotterySetting;
use Webklex\IMAP\Facades\Client as Imap;
use App\Models\Email;
use App\Models\EmailAttachment;
use App\Helpers\CustomAttachmentMask;

class ActionsController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(); //GuzzleHttp\Client
    }

    public function test()
    {
        // $receipt = Plaque::with('order')
        //     ->where('id', 1)
        //     ->first();
 
        // event(new SendPlaqueReceipt($receipt));



        $oClient = Imap::account('default');
        $oClient->connect();
        $oClient->setDefaultAttachmentMask(CustomAttachmentMask::class);

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
                $attachments = $oMessage->getAttachments();

                foreach($attachments as $attachment) {
                    $masked_attachment = $attachment->mask();

                    $masked_attachment->custom_save();
                }
            }
        }


    }

    public function getAddresses(Request $request)
    {
        $url = 'https://api.getAddress.io/find/' . $request->input('postcode');

        $response = $this->client->get($url . '?api-key=' . \Config::get('custom.getaddress_api_key') . '&expand=true', []);

        return $response->getBody()->getContents();
    }

    public function uploadFile(Request $request)
    { 
        $this->validate($request, [ 
            'file' => 'required|mimes:mp4'
        ]);

        if ($request->hasFile('file')) { 
            $file = $request->file('file');

            $filename = time() . '.' . $file->getClientOriginalExtension();
            
            $file->storeAs( 'public', $filename );

            $oldfile = LotterySetting::where('key', 'video_name')
                ->first()
                ->value;

            Storage::disk('public')->delete($oldfile);

            $lotterySetting = LotterySetting::where('key', 'video_name')
                ->update(['value' => $filename]);

            return response()->json(['Upload Success']); 
        }
    }

    public function readFile() { 
        $files = scandir(storage_path('app/public')); 

        $allFile = array_diff($files, ['.', '..', '.gitignore']);

        return response()->json($allFile, 200);
    }

    public function streamVideo() {
        $video_name = LotterySetting::where('key', 'video_name')
            ->first()
            ->value;

        $fileContents = Storage::disk('public')->get($video_name);
        $response = \Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");

        return $response;
    }

    public function checkout(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_API_SECRET'));

            $charge = Stripe::charges()->create([
                'amount' => 16.00,
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'statement_descriptor' => 'Memorial Plaque',
                'description' => 'Memorial Plaque',
            ]);

            PlaqueOrder::where('plaque_id', $request->customer)
                ->update([
                    'charge_id' => $charge['id'],
                    'credit_card_brand' => $charge['payment_method_details']['card']['brand'],
                    'credit_card_last_four' => $charge['payment_method_details']['card']['last4'],
                    'amount' => 16.00,
                    'paid' => 1
                ]);

            $receipt = Plaque::with('order')
                ->where('id', 1)
                ->first();
 
            event(new SendPlaqueReceipt($receipt));
            
            // SUCCESSFUL
            return back()->with('success_message', 'Thank you! Your payment has been accepted.');
        } catch (CardErrorException $e) {
            // save info to database for failed
            PlaqueOrder::where('plaque_id', $request->customer)
                ->update([
                    'plaque_id' => $request->customer,
                    'charge_id' => $charge['id'],
                    'amount' => 16.00,
                    'paid' => 0
                ]);

            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
