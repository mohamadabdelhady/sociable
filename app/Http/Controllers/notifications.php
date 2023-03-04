<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class notifications extends Controller
{
    public function remove_notification($id)
    {
        \App\Models\notifications::where('receiver',$id)->delete();
        return response('The notification has been deleted.',200);
    }
    public function load_notifications()
    {
        $notifications=\App\Models\notifications::where('receiver',auth()->id())->get();

        return response($notifications,200);
    }
}
