<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Tweet;
use App\Comment;
use App\Like;
use App\Http\Requests\CreateTweet;
use App\Http\Requests\UpdateTweet;
use Auth;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tweet::class, 'tweet');
    }

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
        
        if( $path = $request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $tweet->image_path = basename($path);
        } 
        
        $tweet->body = $request->body;
        
        Auth::user()->tweets()->save($tweet);

        return redirect()->route('tweets.top');
    }

    public function edit(Tweet $tweet) 
    {
        return view('tweets.edit', ['tweet' => $tweet]);
    }

    public function update(UpdateTweet $request, Tweet $tweet) 
    {
        if( $path = $request->file('image')) {
            Storage::delete('public/image/' . $tweet->image_path);
            $path = $request->file('image')->store('public/image');
            $tweet->image_path = basename($path);
        } 

        $tweet->body = $request->body;
        Auth::user()->tweets()->save($tweet);

        return redirect()->route('tweets.index');
    }

    public function destroy(Tweet $tweet) 
    {
        if( $tweet->image_path) {
            Storage::delete('public/image/' . $tweet->image_path);
        } 
        $tweet->delete();
        return redirect()->route('tweets.index');
    }
}
