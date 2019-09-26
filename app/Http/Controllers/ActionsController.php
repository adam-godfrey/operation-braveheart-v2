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
        $url = $request->has('house') ? 'https://api.getAddress.io/find/' . $request->postcode . '/' . $request->house : 'https://api.getAddress.io/find/' . $request->postcode;

        $result = $this->client->get($url . '?api-key=vwukZY5maUminZ7pjdx86Q21331', []);

        return $result;
    }
}
