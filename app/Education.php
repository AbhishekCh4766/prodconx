<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'tbl_user_education';

    protected $fillable = ['title','start_year','end_year','location'];
}
