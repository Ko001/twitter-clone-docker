<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Like;
use Auth;

class LikeController extends Controller
{
    public function tweetLike(Request $request)
    {
        $alreadyLiked = Like::where([
                    ['tweet_id', $request->tweet_id],
                    ['user_id', Auth::id()]
                ])->first();

        if(!$alreadyLiked) {
            $like = new Like();
            $like->tweet_id = $request->tweet_id;
            Auth::user()->likes()->save($like);
        } else {
            $alreadyLiked->delete();
        }

        $tweet_likes_count = Tweet::withCount('likes')->findOrFail($request->tweet_id)->likes_count;
        $param = [
            'tweet_likes_count' => $tweet_likes_count
        ];
        return response()->json($param);
    }
    

    
}
