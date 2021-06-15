<?php

namespace App\Http\Controllers;
use DB;
use App\Events\MessageSend;
use App\Models\messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chat extends Controller
{
    public function get_user($id)
    {
        $userdata=DB::table('users')->select('id','first_name','last_name','profile_img')
            ->where('id',$id)->get();
        return view('chat')->with(compact('userdata'));
    }
public function send_message(Request $request)
{

}
}
