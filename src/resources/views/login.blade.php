@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection


@section('content')
<div class="login-container">
    <h2 class="login-title">Login</h2>
    <div class="login-box">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="例: test@example.com" required>
                @error('email')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="例: coachtech1106" required>
                @error('password')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="login-button">ログイン</button>
        </form>
    </div>
</div>
@endsection