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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'TweetController@index')->name('tweets.top');
    Route::resource('tweets', 'TweetController');
    Route::resource('tweets.comments', 'CommentCOntroller');
    Route::resource('users', 'UserController', ['only' => [
        'show', 'edit', 'update'
    ]]);

    Route::post('tweets/like', 'LikeController@tweetLike')->name('tweets.like');
    Route::post('comments/like', 'LikeController@commentLike')->name('comments.like');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
