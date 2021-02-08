@extends('layouts.app')

@section('content')
  <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="tweets-container post">
        <div class="tweet-header ">
          <p class="tweeter-name">ユーザー情報</p>
          
        </div>
        <p>ユーザー名:
          <input type="text" name="name" class="tweet-content text-box" value="{{ old('name') ?? $user->name}}">
        </p>
        <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </form>
@endsection
