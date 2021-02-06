<?php

namespace App\Http\Controllers;

use Auth;
use App\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request) {
        $text = null;

        $alreadyFollowed = Follow::where([
            ['user_id', Auth::id()],
            ['following_id', $request->following_id]
        ])->first();

        if(!$alreadyFollowed) {
            $follow = new Follow();
            $follow->following_id = $request->following_id;
            Auth::user()->follows()->save($follow);
            $text = 'フォロー中';
        } else {
            $alreadyFollowed->delete();
            $text = 'フォローする';
        }

        $follower_count = Follow::where("following_id", $request->following_id)->count();

        $params = [
            'text' => $text,
            'follower_count' => $follower_count
        ];

        return response()->json($params);
    }
}
