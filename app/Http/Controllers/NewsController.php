<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $news = News::paginate(2);

        $data =  [
            'page' => (object) [
                'title' => 'News',
                'description' => 'What\'s going on at ' . \Config::get('app.name')
            ],
            'news' => $news
        ];

        return View('news.index')->with($data);
    }

    public function show($id)
    {
        $item = News::where('id', $id)->first();

        $news = News::paginate(2);

        $data =  [
            'page' => (object) [
                'title' => 'News',
                'description' => 'What\'s going on at ' . \Config::get('app.name')
            ],
            'item' => $item,
            'news' => $news
        ];

        return View('news.show')->with($data);
    }
}
