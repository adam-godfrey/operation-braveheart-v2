<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\LotteryDraw;
use App\Models\Admin\LotterySetting;
use App\Models\Admin\LotteryPlayer;

class LotteryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $lotteryDraw = LotteryDraw::where('active', 1)->get();

        $draw_date = LotterySetting::select('value')
                ->where('key', 'draw_date')
                ->first()
                ->value;

        foreach(['UK', 'Local'] as $draw_type) {
            $lotterySettings = LotterySetting::where('key', 'like', $draw_type . '%')
                ->get();

            $prizes = $lotterySettings->filter(function($item) {
                return substr($item->key, -5) === 'prize' && $item->value != null;
            }); 

            $winners = $lotterySettings->filter(function($item) {
                return substr($item->key, -7) === 'winners';
            })->first();

            $i = 0;
            foreach($prizes->take($winners->value) as $prize) {
                $i++;

                preg_match('~_(.*?)_~', $prize->key, $output);

                $winning_number = LotteryDraw::where('draw_date', $draw_date)
                    ->where('draw_type', $draw_type)
                    ->where('active', 1)
                    ->first()->{$output[1]};

                $player = LotteryPlayer::where('lottery_number', $winning_number)
                    ->where('draw_type', $draw_type)
                    ->first();

                $result[$draw_type][$output[1]] = (object) [
                    'winner' => ucwords(strtolower($player->name)),
                    'prize' => $prize->value,
                    'number' => $winning_number
                ];
            }
        }

        $data =  [
            'page' => (object) [
                'title' => 'Lottery',
                'description' => 'Have you won this month\'s lottery?'
            ],
            'lottery' => (object) $result
        ];

        // dd($data);

        return View('lottery.index')->with($data);
    }

    public function payment()
    {
        $data =  [
            'page' => (object) [
                'title' => 'Lottery',
                'description' => 'Have you won this month\'s lottery?'
            ],
        ];

        return View('lottery.payment')->with($data);
    }
}
