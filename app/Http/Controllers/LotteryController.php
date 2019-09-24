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
            'video_id' => '10153231379946729',
            'lottery' => (object) [
                'prize' => (object) [
                    'first' => (object) [
                        'prize' => '50',
                        'winner' => 'Not me'
                    ],
                    'second' => (object) [
                        'prize' => '30',
                        'winner' => 'Not me'
                    ],
                    'third' => (object) [
                        'prize' => '20',
                        'winner' => 'Not me'
                    ]
                ]
            ]
        ];

        return View('lottery.index')->with($data);
    }
}
