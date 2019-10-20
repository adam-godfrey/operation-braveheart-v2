<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Event;
use App\Events\SendContactFormAutoResponse;
use App\Events\SendContactFormForwarder;

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
                'description' => 'Have a question?'
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
        
        $content = new \stdClass();
        $content->name = $request->input('name');
        $content->email = $request->input('email');
        $content->message = $request->input('message');

        event(new SendContactFormAutoResponse($content));

        event(new SendContactFormForwarder($content));

        return response()->json(null, 200);
    }
}
