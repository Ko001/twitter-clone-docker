<?php

namespace App\Http\Controllers;
use App\User;
use App\Tweet;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user) {
        $tweets = Tweet::where('user_id', $user->id)->orderBy('tweets.created_at', 'desc')->limit(8)->get();
        return view('users.show', ['user' => $user, 'tweets' => $tweets]);
    }
}
