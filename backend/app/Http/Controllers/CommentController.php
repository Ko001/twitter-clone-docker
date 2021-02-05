<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Tweet;
use Auth;
use App\Http\Requests\CreateComment;

class CommentController extends Controller
{
    public function store(CreateComment $request, Tweet $tweet) 
    {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::id();
        $tweet->comments()->save($comment);

        return redirect()->route('tweets.show', ['tweet' => $tweet->id]);
    }
}
