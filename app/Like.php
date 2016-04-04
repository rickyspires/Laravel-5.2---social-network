<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //1 user and 1 post

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
