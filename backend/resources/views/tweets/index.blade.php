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
    <form action="{{ route('tweet.store') }}" method="post">
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
      <a  href="#" class="tweeter-name">{{ $tweet->user->name }}</a>
      <div class="edit-nav">
        <a href="#" class="tweet-edit p-2" >編集</a>
        <a href="#" class="tweet-destroy p-2">削除</a>
      </div>
      
    </div>
    
    <div class="tweet-content "><p>{{ $tweet->body }}</p></div>
    <div class="tweet-time ">{{ $tweet->created_at }}</div>
  </div>
  @endforeach
    


@endsection