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

        $userdata=DB::table('users')->select('id','first_name','last_name','profile_img','cover_img')
            ->where('id',$id)->first();



        if($id!=auth()->id()) {
            return view('show-prof')->with(compact('userdata'));
        }
        else
            return view('profile');
//dd($userdata);
    }

}
