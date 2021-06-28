<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class create_post extends Controller
{
   function store(Request $request)
   {
       $this->validate($request,[
            'inputimg'=>['image','mimes:jpeg,png,jpg,gif,svg','max:5000'],
            'inputvid'=>['mimes:mp4,mov,ogg,mkv','max:20000'],
        ]);

       if($request->hasFile('inputimg')) {
            $imageName = time() . '.' . $request->file('inputimg')->extension();
            $path = $request->file('inputimg')->move(public_path('images/post_img'), $imageName);
            $img_size = $path->getSize();
           $img = posts::create([
               'user_id'=>Auth::id(),
               'image_dir' => $imageName,
               'post_content'=>$request->input('textinput'),
               'size'=>$img_size,
           ]);
        }
       else if($request->hasFile('inputvid')) {
           $imageName = time() . '.' . $request->file('inputvid')->extension();
           $pathv = $request->file('inputvid')->move(public_path('images/post_vid'), $imageName);
           $img_size = $pathv->getSize();
           $img = posts::create([
               'user_id'=>Auth::id(),
               'video_dir' => $imageName,
               'post_content'=>$request->input('textinput'),
               'size'=>$img_size,
           ]);
       }
       else if($request->input('textinput')!=""){
           $img = posts::create([
               'user_id'=>Auth::id(),
               'post_content'=>$request->input('textinput'),
           ]);
       }
       else
       {
           $this->validate($request,['textinput'=>['required']]);
       }
       return back();
   }

}
