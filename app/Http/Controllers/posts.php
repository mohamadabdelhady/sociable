<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class posts extends Controller
{
    public function create_post(Request $request)
    {
        $post=new \App\Models\posts();
        $post->post_text=$request->Text;
        $post->user_id=auth()->user()->id;


        if($request->hasFile('media'))
        {
            $request->validate([
                'media' => 'mimes:avi,mpeg,png,jpg,mp3|max:66560'
            ]);
            $post->media=Storage::disk('public')->putFile('media_files', $request->file('media'));
            $post->media_type=$request->type;
        }
        $post->save();

        return response('The post posted successfully.',200);
    }
    public function load_news_feed()
    {
       $posts=\App\Models\posts::from('posts as p')->whereIn('user_id',function ($query){
           $id=auth()->id();
          $query->where('user_id',$id)->from('friends')->select('friend_id');
       })->join('users As u','u.id','=','user_id')->select('user_id','post_text','likes','dislikes','media','media_type','p.created_at','u.first_name','u.last_name','u.profile_img')->paginate(10);
        return $posts;
    }
}
