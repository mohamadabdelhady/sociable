<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function get_uer_name_and_img(Request $request)
    {
    $first = DB::table('users')->where('id', Auth::id())->value('first_name');
    $last= DB::table('users')->where('id', Auth::id())->value('last_name');
    $username=$first." ".$last;
    $prof_img=DB::table('users')->where('id', Auth::id())->value('profile_img');
    $cover_img=DB::table('users')->where('id', Auth::id())->value('cover_img');
    $current=$request->path();
     return view("$current")->with(['username' => $username,'prof_img'=>$prof_img,'cover_img'=>$cover_img]);

    }
}
