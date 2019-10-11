<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Postcode;
use App\Rules\Telephone;

class MemorialGardenController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Memorial Garden',
                'description' => 'We shall not forget the fallen',
                'banner' => 'images/operation-braveheart-memorial-garden.webp'
            ]
        ];

        return View('memorial-garden.index')->with($data);
    }

    public function add()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Memorial Garden',
                'description' => 'Remember Me',
                'banner' => 'images/operation-braveheart-memorial-garden.webp'
            ]
        ];

        return View('memorial-garden.add')->with($data);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|string',
            'email' => 'required|email',
            'address1' => 'required',
            'town' => 'required',
            'county' => 'required',
            'postcode' => ['required', new Postcode],
            'telephone' => ['sometimes', new Telephone],
            'rank' => 'required|string',
            'name' => 'required',
            'dob' => 'required|string',
            'dod' => 'required',
            'regiment' => 'required|string',
            'location' => 'required|string',
            'message' => 'required|sring',   
        ]);

        return response()->json($request->all(), 200);
    }
}
