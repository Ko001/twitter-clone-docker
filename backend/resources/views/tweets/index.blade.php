@extends('layouts.app')

@section('content')
  @foreach($tweets as $tweet)
  <div class="tweets-container">
  
    <div class="tweet-header ">
      <a  href="#" class="tweeter-name">ツイ主の名前</a>
      <div class="edit-nav">
        <a href="#" class="tweet-edit p-2" >編集</a>
        <a href="#" class="tweet-destroy p-2">削除</a>
      </div>
      
    </div>
    
    <div class="tweet-content "><a>{{ $tweet->body }}</a></div>
    <div class="tweet-time ">{{ $tweet->created_at }}</div>
  </div>
  @endforeach
    


@endsection