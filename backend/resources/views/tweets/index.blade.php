@extends('layouts.app')

@section('content')
  @foreach($tweets as $tweet)
  <div class="tweets-container">
  
    <div class="tweet-header ">
      <div class="edit-nav d-inline d-flex justify-content-end">
        <div class="tweet-edit d-inline p-2" >編集</div>
        <div class="tweet-destroy d-inline p-2">削除</div>
      </div>
      <div class="tweeter-name d-inline">ツイ主の名前</div>
    </div>
    
    <div class="tweet-content ">{{ $tweet->body }}</div>
    <div class="tweet-time ">{{ $tweet->created_at }}</div>
  </div>
  @endforeach
    


@endsection