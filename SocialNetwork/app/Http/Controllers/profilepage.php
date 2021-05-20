<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class profilepage extends Controller
{
public function get_all_data()
{
    $followers= DB::select('SELECT id,first_name,last_name,profile_img FROM users WHERE id IN (SELECT follower_id FROM followers where id =1);');
    return view('profile')->with(compact('followers'));
}
}

