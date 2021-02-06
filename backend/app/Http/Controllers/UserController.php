<?php

namespace App\Http\Controllers;
use App\User;
use App\Tweet;
use App\Follow;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
    public function show(User $user) {
        $followNum = $this->followNum($user->id);

        $tweets = Tweet::withCount('likes')->where('user_id', $user->id)->orderBy('tweets.created_at', 'desc')->limit(8)->get();
        return view('users.show', ['user' => $user, 'tweets' => $tweets, 'followNum' => $followNum]);
    }

    public function edit(User $user) {
        //後で認証設定が必要
        if($user->id != Auth::id() ) {
            return redirect()->route('tweets.top');
        } else {
            return view('users.edit', ['user' => $user]);
        }
    }

    public function update(UpdateUser $request, User $user) {
        $user->name = $request->name;
        $user->save();

        return redirect()->route('users.show', ['user' => $user]);
    }

    private function followNum($user_id) {
        $followNum = array('following' => '0', 'followed' => 0);
        $followNum['following'] = Follow::where('user_id', $user_id)->count();
        $followNum['followed'] = Follow::where('following_id', $user_id)->count();

        return $followNum;
    }
}
