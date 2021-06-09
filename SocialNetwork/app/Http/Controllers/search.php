<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class search extends Controller
{

public function search(Request $request)
{
    $key = trim($request->input('q'));
//    $posts = posts::query()
//        ->where('title', 'like', "%{$key}%")
//        ->orWhere('post_content', 'like', "%{$key}%")
//        ->orderBy('created_at', 'desc')
//        ->get();
//    $posts=DB::select('SELECT p.id,title,post_content,image_dir,video_dir,p.created_at,first_name,last_name,profile_img
//    FROM users AS u,posts AS p
//    WHERE title like "%mo%" OR post_content like "%mo%" AND user_id=u.id');
//$posts= DB::table('users AS u,posts AS p')
//    ->select('p.id as post_id','title','post_content','image_dir','video_dir','p.created_at as post_date','first_name','last_name','profile_img')
//    ->where('title', 'like', "%{$key}%")
//    ->orWhere('post_content', 'like', "%{$key}%")
//    ->orderBy('p.created_at', 'desc')
//    ->get();
    $posts= DB::table('users AS u')
        ->join('posts As p', 'u.id', '=', 'p.user_id' )
        ->select('p.id as post_id','title','post_content','image_dir','video_dir','p.created_at as post_date','first_name','last_name','profile_img')
        ->where('title', 'like', "%{$key}%")
        ->orWhere('post_content', 'like', "%{$key}%")
        ->orderBy('p.created_at', 'desc')
        ->get();
    $user = User::query()
        ->where('first_name', 'like', "%{$key}%")
        ->orWhere('last_name', 'like', "%{$key}%")
        ->orderBy('created_at', 'desc')
        ->get();
    $user_num=count($user);
    $post_num=count($posts);
    $total=$user_num+$post_num;

    $current=$request->path();

    return view("$current")->with(compact( 'user', 'posts', 'post_num', 'user_num','total'));
//echo "$user";

}
}
