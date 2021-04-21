<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	 if (!Auth::check()) {
    return view('home');}
    else
    {
    	return redirect()->route('main');
    }
});
Route::get('main',  ['as' => 'main', 'uses' => 'App\Http\Controllers\UserController@get_uer_name_and_img'])->middleware('auth');
Route::get('/return-home', function () {
    return view('home');
});
Route::get('/home', function () {
    if (Auth::check()) {
    	// echo "you are in";
    	return redirect()->route('main');
    }
})->middleware(['auth','verified']);
Route::get('profile',  ['as' => 'profile', 'uses' => 'App\Http\Controllers\UserController@get_uer_name_and_img'])->middleware('auth');
Route::get('/signup', function () {
     return view('signup-form');
    
});
