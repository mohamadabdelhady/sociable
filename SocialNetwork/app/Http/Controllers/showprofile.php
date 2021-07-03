<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Auth;
class showprofile extends Controller
{
    public function get_all_data(Request $request,$id)
    {
        $userdata=DB::table('users')->select('id','first_name','last_name','profile_img','cover_img','bio')
            ->where('id',$id)->first();
        $is_exist=false;
        $is_request=false;
        $req=DB::table('friend_requests')->where('from',\auth()->id())->where('to',$id)->get();
        $user=DB::table('followers')->where('follower_id',$id)->where('id',auth()->id())->get();
        if(count($user)==1){$is_exist=true;}
        if(count($req)>=1){$is_request=true;}
        $followers= DB::select("SELECT id,first_name,last_name,profile_img FROM users WHERE id IN (SELECT follower_id FROM followers where id =$id);");
        $posts= DB::select("SELECT *  FROM posts WHERE user_id=$id;");
        $post_num=count($posts);
        if($id!=auth()->id()) {

            return view('show-prof')->with(compact('userdata','followers','is_exist','post_num','posts','is_request'));
        }
        else {
            return redirect()->route('profile');
        }

    }

}
