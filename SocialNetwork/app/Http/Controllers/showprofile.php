<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Auth;
class showprofile extends Controller
{
    public function get_all_data(Request $request,$id)
    {
        $userdata=DB::table('users')->select('id','first_name','last_name','profile_img','cover_img')
            ->where('id',$id)->first();
        $is_exist=false;
        $user=DB::table('followers')->where('follower_id',$id)->where('id',auth()->id())->get();
        if(count($user)==1){$is_exist=true;}
        if($id!=auth()->id()) {
            return view('show-prof')->with(compact('userdata','is_exist'));
        }
        else {
            return view('profile');
        }

    }

}
