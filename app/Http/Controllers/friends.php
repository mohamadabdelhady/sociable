<?php

namespace App\Http\Controllers;

use App\Events\RealTimeNotification;
use App\Events\RealTimeRequests;
use App\Models\friend_requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class friends extends Controller
{
//        event(new RealTimeNotification('hello world',auth()->user()->id));

    public function send_friend_request(Request $request){
        $is_request=friend_requests::where('requester',auth()->id())->first();
        $is_receiver=friend_requests::where('receiver',$request->friend_id)->first();
        if($is_request==null||$is_receiver==null) {
            $message = auth()->user()->first_name . " " . auth()->user()->last_name . " want to be your friend.";
            $requester_avatar = auth()->user()->profile_img;
            if ($requester_avatar == null) {
                $requester_avatar = "default";
            }
            event(new RealTimeRequests($message, $request->friend_id, auth()->user()->id, $requester_avatar));
            $F_request = new friend_requests();
            $F_request->requester = auth()->user()->id;
            $F_request->receiver = $request->friend_id;
            $F_request->save();
            return response('Your request has been sent successfully.', 200);
        }
        else{
            return response('The request has already been sent.',403);
        }
    }
    public function accept($requester)
    {
        $friend=new \App\Models\friends();
        $friend->user_id=auth()->user()->id;
        $friend->friend_id=$requester;
        $friend->save();

        $friend2=new \App\Models\friends();
        $friend2->user_id=$requester;
        $friend2->friend_id=auth()->user()->id;
        $friend2->save();
        friend_requests::where('requester',$requester)->delete();
        $message=auth()->user()->first_name.' '.auth()->user()->last_name.' accepted your friend request.';
        event(new RealTimeNotification($message,$requester));
        $notification=new \App\Models\notifications();
        $notification->message=$message;
        $notification->receiver=$requester;
        $notification->save();
        return response('request accepted successfully',200);
    }
    public function decline($requester)
    {
        friend_requests::where('requester',$requester)->delete();
        return response('request declined successfully',200);
    }
    public function load_friend_request()
    {
   $requests=DB::select('select id,first_name,last_name,profile_img from users where id IN (select requester from friend_requests where receiver='.auth()->id().');');
        return response($requests);
    }
}
