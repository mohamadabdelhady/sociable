<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class show_post extends Controller
{
    public function getpost()
    {
        $query=DB::table('posts')->all();
        return back()->with($query);
    }
}
