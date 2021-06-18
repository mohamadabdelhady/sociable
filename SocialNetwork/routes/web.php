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
Route::get('main',  ['as' => 'main', 'uses' => 'App\Http\Controllers\mainpage@get_all_data'])->middleware('auth');
Route::get('/return-home', function () {
    return view('home');
});
Route::get('/chat', function () {
    return view('chat');
});
Route::get('/home', function () {
    if (Auth::check()) {
    	// echo "you are in";
    	return redirect()->route('main');
    }
})->middleware(['auth','verified']);
Route::get('profile',  ['as' => 'profile', 'uses' => 'App\Http\Controllers\mainpage@get_all_data'])->middleware('auth');
Route::get('/signup', function () {
     return view('signup-form');

});
Route::post('crtpost',['as' => 'crtpost', 'uses' => 'App\Http\Controllers\create_post@store'])->middleware('auth');
Route::post('prof_ch',['as' => 'prof_ch', 'uses' => 'App\Http\Controllers\change_img@change_prof'])->middleware('auth');
Route::post('cover_ch',['as' => 'cover_ch', 'uses' => 'App\Http\Controllers\change_img@change_cover'])->middleware('auth');
Route::post('cover_rm',['as' => 'cover_rm', 'uses' => 'App\Http\Controllers\change_img@rm_cover'])->middleware('auth');
Route::post('profile_rm',['as' => 'profile_rm', 'uses' => 'App\Http\Controllers\change_img@rm_profile'])->middleware('auth');
Route::get('search-results',  ['as' => 'search-results', 'uses' => 'App\Http\Controllers\search@search'])->middleware('auth');
Route::GET('get-profile/{id}',  ['as' => 'get-profile/{id}', 'uses' => 'App\Http\Controllers\showprofile@get_all_data'])->middleware('auth');
Route::post('follow', [App\Http\Controllers\follow::class, 'following'])->name('follow');
Route::post('unfollow', [App\Http\Controllers\follow::class, 'unfollowing'])->name('unfollow');
Route::get('profile',  ['as' => 'profile', 'uses' => 'App\Http\Controllers\profilepage@get_all_data'])->middleware('auth');
Route::post('like', [App\Http\Controllers\ratesys::class, 'like'])->name('like');
Route::post('dislike', [App\Http\Controllers\ratesys::class, 'dislike'])->name('dislike');
Route::POST('loadcomment', [App\Http\Controllers\loadcomments::class, 'load'])->name('loadcomment');
Route::GET('loadcomment', [App\Http\Controllers\loadcomments::class, 'load'])->name('loadcomment');
Route::POST('postcomment', [App\Http\Controllers\comment::class, 'post'])->name('postcomment');
Route::GET('postcomment', [App\Http\Controllers\comment::class, 'post'])->name('postcomment');
Route::GET('chat/{id}', [App\Http\Controllers\chat::class, 'get_user'])->name('chat/{id}');
Route::POST('send_message', [App\Http\Controllers\chat::class, 'send_message'])->name('send_message');
Route::GET('send_message', [App\Http\Controllers\chat::class, 'send_message'])->name('send_message');
Route::GET('get_messages{id}', [App\Http\Controllers\chat::class, 'get_all_message'])->name('get_messages{id}');
Route::GET('get_followers', [App\Http\Controllers\chat::class, 'get_followers'])->name('get_followers');
