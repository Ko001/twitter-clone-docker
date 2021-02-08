@extends('layouts.app')

@section('content')

  <div class="tweets-container post">
      @if($errors->any())
          <ul >
            @foreach($errors->all() as $message)
              <li>{{ $message }}</li>
            @endforeach
          </ul>
      @endif
    <form action="{{ route('tweets.comments.update', ['tweet' => $tweet->id, 'comment' => $comment->id]) }}" method="POST">
        @csrf
        @method('PUT')

      <div class="tweet-header ">
        <p class="tweeter-name">編集</p>
      </div>
      <input type="text" name="body" class="tweet-content text-box" value="{{ old('body') ?? $comment->body }}">
      <div class="tweet-button"><button type="submit" class="btn btn-primary">更新</button></div>
    </form>
  </div>
@endsection