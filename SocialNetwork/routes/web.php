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
Route::get('/senti', function () {
    return view('sentimental_analysis');
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
Route::post('like', [App\Http\Controllers\ratesys::class, 'like'])->name('like')->middleware('auth');
Route::post('dislike', [App\Http\Controllers\ratesys::class, 'dislike'])->name('dislike')->middleware('auth');
Route::POST('loadcomment', [App\Http\Controllers\loadcomments::class, 'load'])->name('loadcomment')->middleware('auth');
Route::POST('postcomment', [App\Http\Controllers\comment::class, 'post'])->name('postcomment')->middleware('auth');
Route::GET('chat/{id}', [App\Http\Controllers\chat::class, 'get_user'])->name('chat/{id}')->middleware('auth');
Route::POST('send_message', [App\Http\Controllers\chat::class, 'send_message'])->name('send_message')->middleware('auth');
Route::GET('get_messages{id}', [App\Http\Controllers\chat::class, 'get_all_message'])->name('get_messages{id}')->middleware('auth');
Route::GET('get_followers', [App\Http\Controllers\chat::class, 'get_followers'])->name('get_followers')->middleware('auth');
Route::POST('settings', [App\Http\Controllers\settings::class, 'get_settings'])->name('settings')->middleware('auth');
Route::GET('accept{id}', [App\Http\Controllers\follow::class, 'accept_req'])->name('accept{id}')->middleware('auth');
Route::GET('decline{id}', [App\Http\Controllers\follow::class, 'decline'])->name('decline{id}')->middleware('auth');
Route::GET('get_request{id}', [App\Http\Controllers\follow::class, 'get_all_request'])->name('get_request{id}')->middleware('auth');
Route::GET('get_sent', [App\Http\Controllers\sentiment::class, 'sentiment'])->name('get_sent')->middleware('auth');
Route::GET('get_all_sent', [App\Http\Controllers\sentiment::class, 'all_sentiment'])->name('get_all_sent')->middleware('auth');
Route::GET('post_search_sentiment', [App\Http\Controllers\sentiment::class, 'post_search_sentiment'])->name('post_search_sentiment')->middleware('auth');
Route::GET('comment_search_sentiment', [App\Http\Controllers\sentiment::class, 'comment_search_sentiment'])->name('comment_search_sentiment')->middleware('auth');
Route::GET('settings', [App\Http\Controllers\settings::class, 'get_settings'])->name('settings')->middleware('auth');
Route::POST('get_post_sentiment', [App\Http\Controllers\sentiment::class, 'get_post_sentiment'])->name('get_post_sentiment')->middleware('auth');
Route::GET('get_post_sentiment/{id}', [App\Http\Controllers\sentiment::class, 'get_post_sentiment'])->name('get_post_sentiment/{id}')->middleware('auth');
