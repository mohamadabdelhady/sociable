<?php

use Illuminate\Support\Facades\Broadcast;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
//$id='chat.{id}';
//dd($id);
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat{receiver}',function (){
    return true;
});
Broadcast::channel('friend_req{receiver}',function (){
    return true;
});
Broadcast::channel('notification{receiver}',function (){
    return true;
});
