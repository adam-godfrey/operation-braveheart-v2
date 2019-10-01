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
                'description' => 'We shall not forget the fallen',
                'banner' => 'images/operation-braveheart-memorial-garden.webp'
            ]
        ];

        return View('memorial-garden.add')->with($data);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        return response()->json($request->all(), 200);
    }
}
