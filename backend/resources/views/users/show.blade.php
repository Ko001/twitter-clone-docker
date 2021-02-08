@extends('layouts.user')
@section('content')

  @foreach($tweets as $tweet)
    <div class="tweets-container">
    
      <div class="tweet-header ">
        <a  href="{{ route('users.show', ['user' => $tweet->user_id]) }}" class="tweeter-name">{{ $tweet->user->name }}</a>
        @if($tweet->user_id == Auth::id())
          <div class="edit-nav">
            <a href="{{ route('tweets.edit', ['tweet' => $tweet->id]) }}" class="tweet-edit p-2" >編集</a>
            <form
              style="display: inline-block;"
              method="POST"
              action="{{ route('tweets.destroy', ['tweet' => $tweet->id]) }}"
          >
              @csrf
              @method('DELETE')

              <button class="tweet-destroy p-2 btn-danger">削除</button>
          </form>
          </div>
        @endif
        
      </div>
      
      <div class="tweet-content ">
        <p>{{ $tweet->body }}</p>
        @if($tweet->image_path)
        <div class="image">
          <img src="{{ asset('storage/image/'. $tweet->image_path) }}" alt="">
        </div>
        @endif
      </div>
      <div class="tweet-time ">{{ $tweet->created_at }}</div>

      @if (!$tweet->isLikedBy(Auth::id()))
        <span class="likes">
            <i class="fas fa-music tweet-like-toggle" data-tweet-id="{{ $tweet->id }}"></i>
          <span class="like-counter">{{ $tweet->likes_count }}</span>
        </span><!-- /.likes -->
      @else
        <span class="likes">
            <i class="fas fa-music heart tweet-like-toggle liked" data-tweet-id="{{ $tweet->id }}"></i>
          <span class="like-counter">{{ $tweet->likes_count }}</span>
        </span><!-- /.likes -->
      @endif
    </div>
  @endforeach

@endsection