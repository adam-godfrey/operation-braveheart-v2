<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'News',
                'description' => 'Blah blah blah'
            ]
        ];

        return View('news.index')->with($data);
    }
}
