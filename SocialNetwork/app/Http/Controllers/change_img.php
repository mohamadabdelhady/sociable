<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class change_img extends Controller
{
    public function change_prof(Request $request)
    {
        $imageName = time() . '.' . 'png';
        $request->file('profimg')->move(public_path('images/users_profile_img'), $imageName);
        User::where('id', Auth::id())
            ->update(['profile_img' => $imageName]);
        return back();
    }
    public function change_cover(Request $request)
    {
        $imageName = time() . '.' . 'png';
        $request->file('coverimg')->move(public_path('images/user_cover_img'), $imageName);
        User::where('id', Auth::id())
            ->update(['cover_img' => $imageName]);
        return back();
    }
}
