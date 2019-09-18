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

    }
}
