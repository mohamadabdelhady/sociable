<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class settings extends Controller
{
    public function get_settings()
    {
return view('settings');
    }
}
