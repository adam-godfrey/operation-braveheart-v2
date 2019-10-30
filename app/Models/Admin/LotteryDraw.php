<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class LotteryDraw extends Model
{
    protected $table = 'lottery-draws';
    protected $appends = ['formattedDate'];

    public function getFormattedDateAttribute()
    {
    	return \Carbon::createFromFormat('Y-m-d', $this->draw_date)->format('dS M Y');
    }
}
