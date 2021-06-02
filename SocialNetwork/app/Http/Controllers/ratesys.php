<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\reactors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ratesys extends Controller
{
    public function like(Request $request)
    {
        $post_id=$request->id;

        if (DB::table('reactors')->where('post_id',$post_id)->where('user_id',auth()->id())
            ->first()==null)
        {
            $like=reactors::create([
                'user_id'=>auth()->id(),
                'post_id'=>$post_id,
                'type'=>'1'
            ]);

            $oldvalue=posts::where('id', $post_id)
                ->value('likes');

            $newvalue=$oldvalue+1;
            posts::where('id', $post_id)
                ->update(['likes'=>$newvalue]);

        }
        elseif (DB::table('reactors')->where('post_id',$post_id)->where('user_id',auth()->id())
                ->value('type')==0)
        {
            $oldvalue=posts::where('id', $post_id)
                ->value('dislikes');

            $newvalue=$oldvalue-1;
            posts::where('id', $post_id)
                ->update(['dislikes'=>$newvalue]);
            $oldvalue=posts::where('id', $post_id)
                ->value('likes');

            $newvalue=$oldvalue+1;
            posts::where('id', $post_id)
                ->update(['likes'=>$newvalue]);
            reactors::where('post_id', $post_id)
                ->where('user_id', auth()->id())
                ->update(['type' => 1]);

               }
        elseif (DB::table('reactors')->where('post_id',$post_id)->where('user_id',auth()->id())
                ->value('type')==1)
        {

            $oldvalue=posts::where('id', $post_id)
                ->value('likes');

            $newvalue=$oldvalue-1;
            posts::where('id', $post_id)
                ->update(['likes'=>$newvalue]);
            reactors::where('post_id', $post_id)
                ->where('user_id', auth()->id())
                ->delete();

        }


        $dislikes=DB::table('posts')->where('id',$post_id)->value('dislikes');
        $likes=DB::table('posts')->where('id',$post_id)->value('likes');
        return response()->json(['likes'=>$likes,'dislikes'=>$dislikes]);
    }
    public function dislike(Request $request)
    {


        $post_id=$request->id;

        if (DB::table('reactors')->where('post_id',$post_id)->where('user_id',auth()->id())
                ->first()==null)
        {
            $dislike=reactors::create([
                'user_id'=>auth()->id(),
                'post_id'=>$post_id,
                'type'=>'0'
            ]);

            $oldvalue=posts::where('id', $post_id)
                ->value('dislikes');

            $newvalue=$oldvalue+1;
            posts::where('id', $post_id)
                ->update(['dislikes'=>$newvalue]);

        }
        elseif (DB::table('reactors')->where('post_id',$post_id)->where('user_id',auth()->id())
                ->value('type')==1)
        {
            $oldvalue=posts::where('id', $post_id)
                ->value('likes');

            $newvalue=$oldvalue-1;
            posts::where('id', $post_id)
                ->update(['likes'=>$newvalue]);
            $oldvalue=posts::where('id', $post_id)
                ->value('dislikes');

            $newvalue=$oldvalue+1;
            posts::where('id', $post_id)
                ->update(['dislikes'=>$newvalue]);
            reactors::where('post_id', $post_id)
                ->where('user_id', auth()->id())
                ->update(['type' => 0]);

               }
        elseif (DB::table('reactors')->where('post_id',$post_id)->where('user_id',auth()->id())
                ->value('type')==0)
        {

            $oldvalue=posts::where('id', $post_id)
                ->value('dislikes');

            $newvalue=$oldvalue-1;
            posts::where('id', $post_id)
                ->update(['dislikes'=>$newvalue]);
            reactors::where('post_id', $post_id)
                ->where('user_id', auth()->id())
                ->delete();

        }
$dislikes=DB::table('posts')->where('id',$post_id)->value('dislikes');
        $likes=DB::table('posts')->where('id',$post_id)->value('likes');
        return response()->json(['likes'=>$likes,'dislikes'=>$dislikes]);
    }
}
