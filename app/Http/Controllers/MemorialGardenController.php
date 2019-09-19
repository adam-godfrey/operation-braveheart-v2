<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'description' => 'Blah blah blah'
            ]
        ];

        return View('memorial-garden.index')->with($data);
    }
}
