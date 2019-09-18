<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Contact Us',
                'description' => 'Blah blah blah'
            ]
        ];

        return View('contact.index')->with($data);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        /*
          Add mail functionality here.
        */
        return response()->json(null, 200);
    }
}
