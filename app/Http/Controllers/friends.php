<?php

namespace App\Http\Controllers;

use App\Events\RealTimeNotification;
use App\Events\RealTimeRequests;
use Illuminate\Http\Request;

class friends extends Controller
{
    public function test()
    {
        event(new RealTimeNotification('hello world',auth()->user()->id));

    }
    public function test2($requester){
        $message=auth()->user()->first_name." ".auth()->user()->last_name." want to be your friend.";
        $requester_avatar=auth()->user()->profile_img;
        event(new RealTimeRequests($message,auth()->user()->id,$requester,$requester_avatar));
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
