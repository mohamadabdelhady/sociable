<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class search extends Controller
{
    public function some()
    {
        return view('pages.search_results');
    }
    public function search(Request $request)
    {
        $key = trim($request->input('q'));
        $people=User::where(DB::raw('lower(first_name)'),'like','%'.$key.'%')->where('id','!=', auth()->user()->id)
            ->orWhere(DB::raw('lower(last_name)'),'like','%'.$key.'%')
            ->select('id','first_name','last_name','profile_img')
            ->get();
        return view('pages.search_results')->with(compact('people'));
    }
}
