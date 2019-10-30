<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\LotteryPayment;

class LotteryPlayer extends Model
{
    protected $table = 'lottery-players';

    public function getActiveAttribute($value)
    {
        return $value === 1 ? true : false;
    }

    public function payments()
    {
        return $this->hasMany(LotteryPayment::class, 'player_id', 'id');
    }
}
