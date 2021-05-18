<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Auth;
class showprofile extends Controller
{
    public function get_all_data()
    {
        $id=request()->segment(count(request()->segments()));
        $userdate=app('App\Http\Controllers\showprofile')->get_uer_name_and_img($id);
        if($id!=auth()->id()) {
            return view('show-prof')->with($userdate);
        }
        else
            return view('profile');
    }
    public function get_uer_name_and_img($id)
    {
        $first = DB::table('users')->where('id', $id)->value('first_name');
        $last= DB::table('users')->where('id', $id)->value('last_name');
        $username=$first." ".$last;
        $prof_img=DB::table('users')->where('id', $id)->value('profile_img');
        $cover_img=DB::table('users')->where('id', $id)->value('cover_img');
        return (['username' => $username,'prof_img'=>$prof_img,'cover_img'=>$cover_img]);

    }
}
