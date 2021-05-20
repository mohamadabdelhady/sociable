<?php

namespace App\Http\Controllers;

use App\Models\followers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use function Symfony\Component\String\b;

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
    public function unfollowing(Request $request)
    {
        $u=DB::table('followers')->where('id',auth()->id())->where('follower_id',$request->input('user_id'),)->delete();
        return back();
    }
}
