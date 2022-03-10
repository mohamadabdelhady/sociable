<?php

namespace App\Http\Controllers;

use App\Events\RealTimeNotification;
use App\Events\RealTimeRequests;
use App\Models\friend_requests;
use Illuminate\Http\Request;

class friends extends Controller
{
//        event(new RealTimeNotification('hello world',auth()->user()->id));

    public function add_friend(Request $request)
    {
        $friend=new \App\Models\friends();
        $friend->user_id=auth()->user()->id;
        $friend->friend_id=$request->friend_id;
        $friend->save();
    }
    public function send_friend_request($id){
        $message=auth()->user()->first_name." ".auth()->user()->last_name." want to be your friend.";
        $requester_avatar=auth()->user()->profile_img;
        event(new RealTimeRequests($message,auth()->user()->id,auth()->user()->id,$requester_avatar));
        $request=new friend_requests();
        $request->requester=auth()->user()->id;
//        dd($request->friend_id);
        $request->receiver=$id;
        $request->save();
        return response('Your request has been sent successfully.',200);
    }
    public function accept($requester)
    {

        return response('request accepted successfully',200);
    }
    public function decline($requester)
    {

        return response('request declined successfully',200);
    }
    public function remove_request($request)
    {

    }
}
