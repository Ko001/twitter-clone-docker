<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Like;
use App\Comment;
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
    
    public function commentLike(Request $request)
    {
        $alreadyLiked = Like::where([
                    ['comment_id', $request->comment_id],
                    ['user_id', Auth::id()]
                ])->first();

        if(!$alreadyLiked) {
            $like = new Like();
            $like->comment_id = $request->comment_id;
            Auth::user()->likes()->save($like);
        } else {
            $alreadyLiked->delete();
        }

        $comment_likes_count = Comment::withCount('likes')->findOrFail($request->comment_id)->likes_count;
        $param = [
            'comment_likes_count' => $comment_likes_count
        ];
        return response()->json($param);
    }

    
}
