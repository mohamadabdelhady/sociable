<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class loadcomments extends Controller
{
    public function load(Request $request)
    {
        $postid=$request->id;
        $comments=DB::select("select comment_content,c.updated_at,first_name,last_name,user_id
        from comments as c,users as u where c.post_id=$postid and u.id=c.user_id ORDER BY updated_at DESC ;");

        return response()->json($comments);
    }
}
