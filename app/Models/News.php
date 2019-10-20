<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{	
    protected $table = 'news';
    protected $appends = ['hashid'];

    public function getHashidAttribute()
	{
	    return \Hashids::encode($this->attributes['id']);
	}
}
