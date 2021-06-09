<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
class mainpage extends Controller
{
    public function get_all_data(Request $request)
    {

        $id=auth()->id();
        $posts= DB::select("SELECT *  FROM posts WHERE user_id IN (SELECT follower_id FROM followers where id =$id)OR user_id=$id;");
        $post_num=count($posts);
        $followers= DB::select("SELECT id,first_name,last_name,profile_img FROM users WHERE id IN (SELECT follower_id FROM followers where id =$id);");
        $current=$request->path();

        return view("$current")->with(compact('post_num','posts','followers'));
    }
}
