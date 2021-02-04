<?php

namespace App\Http\Controllers;
use App\User;
use App\Tweet;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function show(User $user) {
        $tweets = Tweet::where('user_id', $user->id)->orderBy('tweets.created_at', 'desc')->limit(8)->get();
        return view('users.show', ['user' => $user, 'tweets' => $tweets]);
    }

    public function edit(User $user) {
        //後で認証設定が必要
        if($user->id != Auth::id() ) {
            return redirect()->route('tweets.top');
        } else {
            return view('users.edit', ['user' => $user]);
        }
    }
}
