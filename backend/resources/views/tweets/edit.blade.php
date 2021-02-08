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
    <form action="{{ route('tweets.update', ['tweet' => $tweet->id]) }}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PUT')

      <div class="tweet-header ">
        <p class="tweeter-name">編集</p>
      </div>
      <input type="text" name="body" class="tweet-content text-box" value="{{ old('body') ?? $tweet->body }}">
      @if($tweet->image_path)
      <div class="image">
        <img src="{{ asset('storage/image/'. $tweet->image_path) }}" alt="">
      </div>
      @endif
      <input type="file" name="image" value="{{ old('image') ?? $tweet->image_path}}">
      <div class="tweet-button"><button type="submit" class="btn btn-primary">更新</button></div>
    </form>
  </div>
@endsection