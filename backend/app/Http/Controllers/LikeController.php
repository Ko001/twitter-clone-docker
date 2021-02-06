<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Like;
use Auth;

class LikeController extends Controller
{
    public function tweetStore(Tweet $tweet)
    {
        $like = new Like();
        $like->tweet_id = $tweet->id;
        Auth::user()->likes()->save($like);

        return back();
    }

    public function tweetDestroy(Tweet $tweet)
    {
        $like = Like::where([
            ['tweet_id', $tweet->id],
            ['user_id', Auth::id()]
        ]);
        $like->delete();

        return back();
    }

    
}
