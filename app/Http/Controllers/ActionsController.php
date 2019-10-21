<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Event;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Mpdf\Mpdf;
use Hashids;
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
        $receipt = Plaque::with('order')
            ->where('id', 1)
            ->first();
 
        event(new SendPlaqueReceipt($receipt));
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

    public function createPDFReceipt($id)
    {
        $decoded = Hashids::connection('alternative')->decode($id);

        if(!is_array($decoded)) {
            return;
        }
        
        $order = Plaque::with('order')
            ->where('id', $decoded[0])
            ->first();

        if($order) {

            $defaultConfig = (new\Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];

            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $stylesheet = file_get_contents(public_path('css/pdf.css'));

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'en',
                'default_font_size' => 10,
                'fontDir' => array_merge($fontDirs, [
                   public_path('fonts')
                ]),
                'fontdata' => $fontData + [
                    'OpenSans' => [
                       'R' => 'open-sans.regular.ttf',
                       'B' => 'open-sans.bold.ttf'
                    ],
                    'MyriadProCondensed' => [
                        'R' => 'myriad-pro-condensed.ttf',  
                    ]
                ],
                'default_font' => 'OpenSans'
            ]);

            $view = \View::make('pdf.receipt', [
                'data' => $order
            ]);

            $html = $view->render();


            $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

            // Output a PDF file directly to the browser
            $mpdf->Output('receipt.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        }
    }
}

/** @var \Webklex\IMAP\Message $oMessage */
class CustomMessageMask extends \Webklex\IMAP\Support\Masks\MessageMask {

    /**
     * New custom method which can be called through a mask
     * @return string
     */
    public function token(){
        return implode('-', [$this->message_id, $this->uid, $this->message_no]);
    }
}
