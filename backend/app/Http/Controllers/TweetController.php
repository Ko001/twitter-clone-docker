<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Comment;
use App\Like;
use App\Http\Requests\CreateTweet;
use App\Http\Requests\UpdateTweet;
use Auth;

class TweetController extends Controller
{
    public function index()
    {
        $tweets =Tweet::with('user')->withCount('likes')->orderBy('tweets.created_at', 'desc')->limit(8)->get();

        return view('tweets.index', ['tweets' => $tweets]);
    }

    public function show(Tweet $tweet)
    {
        $countLikes = Like::where('tweet_id', $tweet->id)->count();
        $comments = Comment::with('user')->withCount('likes')->where('tweet_id', $tweet->id)->orderBy('comments.created_at', 'desc')->limit(8)->get();
        
        return view('tweets.show', ['tweet' => $tweet, 'comments' => $comments, 'likeNum' => $countLikes]);
    }

    public function store(CreateTweet $request) 
    {
        $tweet = new Tweet();
        $tweet->body = $request->body;
        Auth::user()->tweets()->save($tweet);

        return redirect()->route('tweets.top');
    }

    public function edit(Tweet $tweet) 
    {
        $this->authorize('isLoggInUser', $tweet);
        return view('tweets.edit', ['tweet' => $tweet]);
    }

    public function update(UpdateTweet $request, Tweet $tweet) 
    {
        $tweet->body = $request->body;
        Auth::user()->tweets()->save($tweet);

        return redirect()->route('tweets.index');
    }

    public function destroy(Tweet $tweet) 
    {
        $tweet->delete();
        return redirect()->route('tweets.index');
    }
}
