<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable; //use built in laravel auth
use Illuminate\Database\Eloquent\Model;

/*
note: if you used a different name other than User for Authenticatable you would also need to change it in config/auth.php - providers i.e Dog
*/

class User extends model implements Authenticatable
{
	//protected $table = 'users2'; //if you change the table name

	use \Illuminate\Auth\Authenticatable; //use built in laravel auth (this is a trait).

	public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}




