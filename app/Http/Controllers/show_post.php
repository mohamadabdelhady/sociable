<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class show_post extends Controller
{
    public function getpost()
    {
        $id=auth()->id();
        $posts= DB::select("SELECT *  FROM posts WHERE user_id IN (SELECT follower_id FROM followers where id =$id)OR user_id=$id;");
        $post_num=count($posts);

        return (compact('posts'))->with($post_num);
    }
}
