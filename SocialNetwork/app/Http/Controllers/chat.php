<?php

namespace App\Http\Controllers;
use DB;
use App\Events\MessageSend;
use App\Models\messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class chat extends Controller
{
    public $currentuser;
    public function get_user($id)
    {
        $userdata=DB::table('users')->select('id','first_name','last_name','profile_img')
            ->where('id',$id)->first();


        return view('chat')->with(compact('userdata'));
    }
public function send_message(Request $request)
{
$chat=messages::create([
    'message_content'=>$request->message,
    'sender'=>Auth::id(),
    'receiver'=>$request->id,
]);
event(new MessageSend($request->message,Auth::id(),$request->id));
}
public function get_all_message($id)
{
$messages=DB::table('messages')->where('sender',Auth::id())->orwhere('sender',$id)->orderby('updated_at','ASC')->get();

return response(json_encode($messages));
}
}
