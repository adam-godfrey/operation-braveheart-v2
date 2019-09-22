<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Operation Braveheart Shop',
                'description' => 'The heart of ' . \Config::get('app.name')
            ]
        ];

        return View('shop.index')->with($data);
    }
}
