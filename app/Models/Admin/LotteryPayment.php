<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class LotteryPayment extends Model
{
    protected $table = 'lottery-payments';

    public function getPaidAttribute($value)
    {
        return $value === 1 ? true : false;
    }
}
