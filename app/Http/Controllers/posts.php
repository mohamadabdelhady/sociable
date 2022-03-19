<?php

namespace App\Http\Controllers;

use App\Models\reactions;
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
       })->join('users As u','u.id','=','user_id')->select('p.id','user_id','post_text','likes','dislikes','media','media_type','p.created_at','u.first_name','u.last_name','u.profile_img')->paginate(10);
        return $posts;
    }
    public function like_post($id)
    {
        $is_dislike=reactions::where('isLike',false)->first();
        if($is_dislike!=null)
        {
            reactions::where('post_id',$id)->delete();
            \App\Models\posts::where('id',$id)->decrement('dislikes',1);
        }
        $reaction=reactions::where('user_id',auth()->id())->where('post_id',$id)->first();
        if ($reaction==null)
        {
            $record_reaction=new reactions;
            $record_reaction->user_id=auth()->id();
            $record_reaction->post_id=$id;
            $record_reaction->isLike=true;
            $record_reaction->save();
            \App\Models\posts::where('id',$id)->increment('likes',1);
            $likes_dislikes=\App\Models\posts::where('id',$id)->select('likes','dislikes')->first();
            return $likes_dislikes;
        }
        else
        {
            return response('You already liked this post',403);
        }
    }
    public function dislike_post($id)
    {
        $is_like=reactions::where('isLike',true)->first();
        if($is_like!=null)
        {
            reactions::where('post_id',$id)->delete();
            \App\Models\posts::where('id',$id)->decrement('likes',1);
        }
        $reaction=reactions::where('user_id',auth()->id())->where('post_id',$id)->first();
        if ($reaction==null)
        {
            $record_reaction=new reactions;
            $record_reaction->user_id=auth()->id();
            $record_reaction->post_id=$id;
            $record_reaction->isLike=false;
            $record_reaction->save();
            \App\Models\posts::where('id',$id)->increment('dislikes',1);
            $likes_dislikes=\App\Models\posts::where('id',$id)->select('likes','dislikes')->first();
            return $likes_dislikes;
        }
        else
        {
            return response('You already disliked this post',403);
        }
    }
}
