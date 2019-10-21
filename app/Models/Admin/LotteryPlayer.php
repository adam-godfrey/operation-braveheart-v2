<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class LotteryPlayer extends Model
{
    protected $table = 'lottery-players';

    public function getActiveAttribute($value)
    {
        return $value === 1 ? 'Yes' : 'No';
    }
}
