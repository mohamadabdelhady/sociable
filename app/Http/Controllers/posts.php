<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $post->media=Storage::putFile('media_files', $request->file('media'));
            $post->media_type=$request->type;
        }
        $post->save();

        return response('The post posted successfully.',200);
    }
    public function load_news_feed()
    {

    }
}
