<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets =Tweet::orderBy('created_at', 'desc')->get();

        return view('tweets.index', ['tweets' => $tweets]);
    }
}
