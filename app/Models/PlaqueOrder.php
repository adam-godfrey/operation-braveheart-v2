<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaqueOrder extends Model
{
    protected $table = 'plaque-orders';
    protected $appends = ['orderid', 'status'];

    public function getOrderidAttribute($value)
    {
        return 'PLQ' . $this->attributes['id'];
    }

    public function getStatusAttribute($value)
    {
    	$status = $this->attributes['status'];

    	switch($status) {
    		case 0:
    			return 'New';
    		case 1:
    			return 'With engraver';
    		case 2:
    			return 'Complete';
    	}
    }
}

