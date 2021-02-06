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

    Route::post('tweets/{tweet}/likes', 'LikeController@tweetStore')->name('likes.tweet.store');
    Route::delete('tweets/{tweet}/likes/', 'LikeController@tweetDestroy')->name('likes.tweet.destroy');
    Route::post('comments/{comment}/likes', 'LikeController@commentStore')->name('likes.comment.store');
    Route::delete('tweets/{comment}/likes/', 'LikeController@commentDestroy')->name('likes.comment.destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
