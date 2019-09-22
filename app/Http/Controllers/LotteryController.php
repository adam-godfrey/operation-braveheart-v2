<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Lottery',
                'description' => 'Have you won this month\'s lottery?'
            ],
            'video_id' => '10153231379946729'
        ];

        return View('lottery.index')->with($data);
    }
}
