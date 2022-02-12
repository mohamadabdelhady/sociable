<?php

namespace App\Http\Controllers;

use App\Models\comments;
use Illuminate\Http\Request;

class comment extends Controller
{
    public function post(Request $request){
        $id=$request->id;
        $content=$request->comment;
        $result=app('App\Http\Controllers\sentiment')->sentiment($content);
        $comment=comments::create([
            'post_id'=>$id,
            'user_id'=>auth()->id(),
            'comment_content'=>$content,
            'Sentiment Score'=>$result['score'],
            'Sentiment magnitude'=>$result['magnitude'],
            'Sentiment_class'=>$result['class']
        ]);


        return response()->json("success");
    }
}
