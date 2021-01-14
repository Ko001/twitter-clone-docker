<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Auth;

class TweetController extends Controller
{
    public function index()
    {
        $tweets =Tweet::orderBy('created_at', 'desc')->get();

        return view('tweets.index', ['tweets' => $tweets]);
    }

    public function store(Request $request) {
        $tweet = new Tweet();

        $tweet->body = $request->body;
        $tweet->user_id = Auth::id();

        $tweet->save();

        return redirect()->route('tweet.top');
    }
}
