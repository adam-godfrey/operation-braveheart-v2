<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\Admin\LotteryBall;
use App\Models\Admin\LotteryPlayer;

trait LotteryTrait
{
    public function getAvailableNumbers(Request $request)
    {
        $lotteryBalls = LotteryBall::select('lottery_number')
        	->where('draw_type', $request->input('draw_type'))
	        ->where(function($q) use ($request) {
	        	$q->where('player_id', $request->input('player_id'))
            		->orWhereNull('player_id');
	        })
            ->get();

            dd($lotteryBalls->count());

        return ['data' => $lotteryBalls->pluck('lottery_number')];
    }

    public function getWinner(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|integer|min:1',           
        ]);

        $lotteryPlayer = LotteryPlayer::where('draw_type', $request->input('draw_type'))
            ->where('lottery_number', $request->input('number'))
            ->first();

        return ['data' => $lotteryPlayer];
    }
}