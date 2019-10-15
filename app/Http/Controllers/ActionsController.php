<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
// use App\Events\VideoUploaded;
use App\Models\Admin\LotterySetting;

class ActionsController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(); //GuzzleHttp\Client
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
}
