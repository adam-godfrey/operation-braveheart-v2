<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plaque;
use App\Models\PlaqueOrder;
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
        // dd($request->all());

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
            'message' => 'required|string',
            'confirm' => 'accepted'
        ]);

        if(is_null($request->input('customer'))) {
            $plaque = new Plaque();

            $plaque->contact = $request->input('contact');
            $plaque->telephone = $request->input('telephone');
            $plaque->email = $request->input('email');
            $plaque->address1 = $request->input('address1');
            $plaque->address2 = $request->input('address2');
            $plaque->address3 = $request->input('address3');
            $plaque->town = $request->input('town');
            $plaque->county = $request->input('county');
            $plaque->postcode = $request->input('postcode');
            $plaque->rank = $request->input('rank');
            $plaque->name = $request->input('name');
            $plaque->dob = $request->input('dob');
            $plaque->dod = $request->input('dod');
            $plaque->regiment = $request->input('regiment');
            $plaque->location = $request->input('location');
            $plaque->message = $request->input('message');

            $plaque->save();

            $plaqueOrder = new PlaqueOrder();

            $plaqueOrder->plaque_id = $plaque->id;

            $plaqueOrder->save();  
        }
        else {
            $plaque = Plaque::where('id', $request->input('customer'))
                ->first();
        } 

        return response()->json(['customer' => $plaque->id], 200);
    }
}
