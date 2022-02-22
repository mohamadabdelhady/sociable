<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class profile extends Controller
{
    public function get_my_profile()
    {
        return view('pages.profile');
    }
    public function upload_profile(Request $request)
    {
            $path=Storage::disk('public')->putFile('users-profiles', $request->file('profile'));
            $user=User::find(auth()->user()->id);
            $user->profile_img=$path;
        return back();
    }
}
