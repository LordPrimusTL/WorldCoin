<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DatabaseController extends Controller
{
    public function TruncateUsers()
    {
    	if(User::truncate())
    	{
    		var_dump(true);
    	}
    	else
    	{
    		var_dump(false);
    	}
    }
}
