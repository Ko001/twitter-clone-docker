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
    <form action="{{ route('tweets.store') }}" method="post">
        @csrf
      <div class="tweet-header ">
        <p class="tweeter-name">新規投稿</p>
      </div>
      <input type="text" name="body" class="tweet-content text-box">
      <div class="tweet-button"><button type="submit" class="btn btn-primary">ツイート</button></div>
    </form>
  </div>

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
    
    <div class="tweet-content "><p>{{ $tweet->body }}</p></div>
    <div class="tweet-time ">
      <p class="">{{ $tweet->created_at }}
      <a href="{{ route('tweets.show', ['tweet' => $tweet->id]) }}" class="tweet-edit p-2" >コメントする</a>
      </p>
      <p class="p-2">{{ $tweet->likes_count}}いいね</p>
    </div>
    
  </div>
  @endforeach
    


@endsection