<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chat extends Controller
{
    public function send(Request $request)
    {
        $message=new \App\Models\chat();
        $message->content=$request->message;
        $message->user_to=$request->user_id;
        $message->user_from=auth()->id();
        $message->save();
        return response('success',200);
    }
    public function load($id)
    {
        $messages=\App\Models\chat::where('user_to',$id)->where('user_from',auth()->id())->get();
        return $messages;
    }
}
