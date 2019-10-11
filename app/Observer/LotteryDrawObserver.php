<?php
 
namespace App\Observer;
 
use App\Models\Admin\LotterySetting;
use App\Models\Admin\LotteryDraw;

class LotteryDrawObserver
{
    public function created(LotteryDraw $draw)
    {
        
    }

    public function updated(LotteryDraw $draw)
    {
    	$lotterySetting = LotterySetting::where('key', 'draw_date')
            ->update([
                'value' => \Carbon\Carbon::now()->toDateString(),
            ]);
    }
}