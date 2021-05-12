<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use Illuminate\Http\Request;


class search extends Controller
{

public function search(Request $request)
{
    $key = trim($request->input('q'));
    $posts = posts::query()
        ->where('title', 'like', "%{$key}%")
        ->orWhere('post_content', 'like', "%{$key}%")
        ->orderBy('created_at', 'desc')
        ->get();

    $user = User::query()
        ->where('first_name', 'like', "%{$key}%")
        ->orWhere('last_name', 'like', "%{$key}%")
        ->orderBy('created_at', 'desc')
        ->get();
    $user_num=$user->count();
    $post_num=$posts->count();
    $total=$user_num+$post_num;
//    return view(route('search-results'))->with($posts,$user);
    $img_name=app()->call('App\Http\Controllers\UserController@get_uer_name_and_img');
    $current=$request->path();
//  echo "$po$sts";
    return view("$current")->with(compact( 'user', 'posts', 'post_num', 'user_num','total'))
        ->with($img_name);


}
}
