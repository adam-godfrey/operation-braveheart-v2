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
                'description' => 'What we do'
            ]
        ];

        return View('about.index')->with($data);
    }
}
