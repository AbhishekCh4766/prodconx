<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Friend extends Model
{
    //
    protected $table = 'tbl_friend_requests';

    public $timestamps = false;

    public function users(){
    	return $this->hasMany('App\User');
    }
}
