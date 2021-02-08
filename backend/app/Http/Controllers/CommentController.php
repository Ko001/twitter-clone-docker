<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateComment;
use App\Comment;
use App\Tweet;
use Auth;
use App\Http\Requests\CreateComment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function store(CreateComment $request, Tweet $tweet) 
    {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::id();
        $tweet->comments()->save($comment);

        return redirect()->route('tweets.show', ['tweet' => $tweet->id]);
    }

    public function edit(Tweet $tweet, Comment $comment)
    {
        return view('comments.edit', ['tweet' => $tweet, 'comment' => $comment]);
    }

    public function update(Tweet $tweet, Comment $comment, UpdateComment $request)
    {
        $comment->body = $request->body;
        $tweet->comments()->save($comment);

        return redirect()->route('tweets.show', ['tweet' => $tweet]);
    }
    public function destroy(Tweet $tweet, Comment $comment) 
    {
        $comment->delete();
        return redirect()->route('tweets.show', ['tweet' => $tweet]);
    }
}
