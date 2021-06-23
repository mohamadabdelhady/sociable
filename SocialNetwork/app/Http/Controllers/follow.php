<?php

namespace App\Http\Controllers;
use App\Events\makerequest;
use App\Models\followers;
use App\Models\friend_requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use function Symfony\Component\String\b;

class follow extends Controller
{
    public function following(Request $request)
    {
        $fname=DB::table('users')->where('id',$request->input('user_id'))->first();

        $message=$fname->first_name." ".$fname->last_name." want to be your friend.";
        $friend_req=friend_requests::create([
            'from'=>Auth::id(),
            'to'=>$request->input('user_id'),
            'message'=>$message,
        ]);


        event(new makerequest(\auth()->id(),$request->input('user_id'),$message));
        return back();
    }
    public function unfollowing(Request $request)
    {
        $u=DB::table('followers')->where('id',auth()->id())->where('follower_id',$request->input('user_id'))->delete();
        $u=DB::table('followers')->where('id',$request->input('user_id'))->where('follower_id',Auth::id())->delete();
        return back();
    }
    public function accept_req($id){
        $follower=followers::create([
           'id'=>Auth::id(),
            'follower_id'=>$id,
        ]);
        $follower=followers::create([
            'id'=>$id,
            'follower_id'=>Auth::id(),
        ]);
        $decline=DB::table('friend_requests')->where('from',$id)->where('to',Auth::id())->delete();
        return back();
    }
    public function decline($id)
    {
        $decline=DB::table('friend_requests')->where('from',$id)->where('to',Auth::id())->delete();
        return back();

    }
    public function get_all_request($id)
    {
        $requests=DB::table('friend_requests')->where('to',Auth::id())->orwhere('from',$id)->orderby('updated_at','ASC')->get();

        return response(json_encode($requests));
    }
}
