<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class mainpage extends Controller
{
    public function get_all_data(Request $request)
    {

        $img_name=app()->call('App\Http\Controllers\UserController@get_uer_name_and_img');
        $current=$request->path();
        $results=null;

        return view("$current")->with($img_name);
    }
}
