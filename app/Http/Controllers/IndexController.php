<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Operation Braveheart',
                'description' => 'Blah blah blah'
            ]
        ];

        return View('home.index')->with($data);
    }
}
