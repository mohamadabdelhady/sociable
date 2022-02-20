<?php

use Illuminate\Support\Facades\Route;

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

//routes that don't require authentication or verification
Route::get('/', function () {
    if (Auth::check()) {

        return redirect()->route('home');
    }
    else
    {
        return view('auth.login');
    }
});
Route::get('/signup', function () {return view('auth.signup');});
Route::get('/login',['as'=>'login','uses'=> function () {return view('auth.login');}]);
//routes that do require authentication and verification
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', ['as' => 'home', 'uses' => function () {
        return view('pages.home');
    }]);
});
