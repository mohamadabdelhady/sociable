<?php

namespace App\Http\Controllers;

use App\Events\RealTimeNotification;
use App\Events\RealTimeRequests;
use App\Models\friend_requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $user->save();
        return back();
    }
    public function upload_cover(Request $request)
    {
        $path=Storage::disk('public')->putFile('users-covers', $request->file('cover'));
        $user=User::find(auth()->user()->id);
        $user->cover_img=$path;
        $user->save();
        return back();
    }
    public function get_profile($id)
    {

        $profile=User::where('id','=',$id)->select('id','first_name','last_name','profile_img','cover_img')->first();
        if (auth()->user()->id!=$id) {
            $F_request=friend_requests::where('receiver',$id)->first();
            $friend=\App\Models\friends::where('friend_id',$id)->first();
            $bio=User::where('id',$id)->select('bio')->first();
//            dd($F_request);
            return view('pages.users_profile')->with(compact('profile','F_request','friend','bio','id'));
        }
        else
        {
            return view('pages.profile');
        }
    }
    public function get_contacts($id)
    {
        $contacts=DB::select('select id,first_name,last_name,profile_img from users where id IN(select friend_id from friends where user_id='.$id.');');
        return response($contacts,200);
    }
    public function save_bio(Request $request)
    {
        $bio=User::find(auth()->id());
        $bio->bio=$request->bio;
        $bio->save();
    }

}
