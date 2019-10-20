<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')
            ->first();

        $data =  [
            'page' => (object) [
                'title' => 'Operation Braveheart',
                'description' => 'Swift and Bold'
            ],
            'news' => $news
        ];

        return View('home.index')->with($data);
    }
}
