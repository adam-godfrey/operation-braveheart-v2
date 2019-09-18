<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'About Us',
                'description' => 'Blah blah blah'
            ]
        ];

        return View('about.index')->with($data);
    }
}
