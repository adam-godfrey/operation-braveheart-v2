<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlaqueOrder;

class Plaque extends Model
{
    protected $table = 'plaque';
    protected $appends = ['hashid'];

    /**
     * Get the phone record associated with the user.
     */
    public function order()
    {
        return $this->hasOne(PlaqueOrder::class, 'plaque_id', 'id');
    }

    public function getHashidAttribute()
	{
	    return \Hashids::connection('alternative')->encode($this->attributes['id']);
	}

    
}
