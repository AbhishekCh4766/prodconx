<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    protected $table = 'tbl_user_experiences';

    protected $fillable = ['company_name','start_year','end_year','location','is_current'];
}
