<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
class profilepage extends Controller
{
public function get_all_data()
{
    $id=auth()->id();
    $followers= DB::select("SELECT id,first_name,last_name,profile_img FROM users WHERE id IN (SELECT follower_id FROM followers where id =$id);");
    $posts= DB::select("SELECT *  FROM posts WHERE user_id=$id;");
    $post_num=count($posts);

    return view('profile')->with(compact('followers','posts','post_num'));
}
public function save_bio(Request $request)
{
    $bio=$request->bio;
    User::where('id', auth()->id())
        ->update(['bio'=>$bio]);
    return back();
}
}

