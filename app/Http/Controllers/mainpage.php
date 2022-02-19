<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;

use DB;
class mainpage extends Controller
{
    public function get_all_data(Request $request)
    {

        $id=auth()->id();
//        $posts= DB::select("SELECT *  FROM posts WHERE user_id IN (SELECT follower_id FROM followers where id =$id)OR user_id=$id;");
        $posts = posts::whereIn('user_id', function ($query) use ($id) {
            $query->select('follower_id')
                ->from('followers')
                ->where('id', $id);
        })->orWhere('user_id', $id)->orderBy('created_at','desc')
            ->paginate(10);

        $post_num=count($posts);
        $followers= DB::select("SELECT id,first_name,last_name,profile_img FROM users WHERE id IN (SELECT follower_id FROM followers where id =$id);");

        $followers_num=count($followers);
        $current=$request->path();

//        if($request->ajax()){
//            $view = view($current,compact('posts'))->render();
//            return response()->json(['html'=>$view]);
//        }
        return view("pages.main")->with(compact('post_num','posts','followers','followers_num'));
    }
}
