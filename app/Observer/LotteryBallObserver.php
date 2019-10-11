<?php
 
namespace App\Observer;
 
use App\Models\Admin\LotteryBall;
use App\Models\Admin\LotteryPlayer;

class LotteryBallObserver
{
    public function created(LotteryBall $ball)
    {
        
    }

    public function updated(LotteryBall $ball)
    {
    	$lotteryPlayer = LotteryPlayer::where('id', $ball->player_id)
            ->update([
                'lottery_number' => $ball->lottery_number,
            ]);
    }
}