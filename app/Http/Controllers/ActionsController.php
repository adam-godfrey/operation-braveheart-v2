<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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
}
