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
Route::get('/test',[\App\Http\Controllers\friends::class,'test']);
Route::get('/test2/{requester}',[\App\Http\Controllers\friends::class,'test2']);
//routes that do require authentication and verification
Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/home', ['as' => 'home', 'uses' => function () {
        return view('pages.home');
    }]);
    Route::post('/create_post',[\App\Http\Controllers\posts::class,'create_post']);
    Route::get('/profile',[\App\Http\Controllers\profile::class,'get_my_profile']);
    Route::post('/upload/profile',[\App\Http\Controllers\profile::class,'upload_profile']);
    Route::post('/upload/cover',[\App\Http\Controllers\profile::class,'upload_cover']);
    Route::post('/search',[\App\Http\Controllers\search::class,'search']);
    Route::get('/get_profile/{id}',[\App\Http\Controllers\profile::class,'get_profile']);
    Route::post('/send_friend_request',[\App\Http\Controllers\friends::class,'send_friend_request']);
    Route::get('/load_request',[\App\Http\Controllers\friends::class,'load_friend_request']);
    Route::get('/decline/{requester}',[\App\Http\Controllers\friends::class,'decline']);
    Route::get('/accept/{requester}',[\App\Http\Controllers\friends::class,'accept']);
    Route::get('/remove_notification/{id}',[\App\Http\Controllers\notifications::class,'remove_notification']);
    Route::get('/load_notification',[\App\Http\Controllers\notifications::class,'load_notifications']);
    Route::get('/get_contact/{id}',[\App\Http\Controllers\profile::class,'get_contacts']);
});
