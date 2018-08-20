<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $table = 'tbl_user_skill';

    protected $fillable = ['skill_name','skill_desc'];
}
