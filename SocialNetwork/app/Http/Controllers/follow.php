<?php

namespace App\Http\Controllers;

use App\Models\followers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class follow extends Controller
{
    public function following(Request $request)
    {
        $follower=followers::create([
            'id'=>Auth::id(),
            'follower_id'=>$request->input('user_id'),
        ]);
        return back();
    }
}
