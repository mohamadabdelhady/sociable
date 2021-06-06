<?php

namespace App\Http\Controllers;

use App\Models\comments;
use Illuminate\Http\Request;

class comment extends Controller
{
    public function post(Request $request){
        $id=$request->id;
        $content=$request->comment;
        $comment=comments::create([
            'post_id'=>$id,
            'user_id'=>auth()->id(),
            'comment_content'=>$content
        ]);
        return response()->json("success");
    }
}
