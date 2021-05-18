<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class mainpage extends Controller
{
    public function get_all_data(Request $request)
    {


        $current=$request->path();
        $results=null;

        return view("$current");
    }
}
