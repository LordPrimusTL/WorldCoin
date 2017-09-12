<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_account extends Model
{
    public $fillable = ['user_id','t_id','t_type','balance'];
}
