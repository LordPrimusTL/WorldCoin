<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function SetWithStatus($status)
    {
        return response()->json(['status' => $status]);
    }
}
