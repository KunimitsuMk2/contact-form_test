@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection


@section('content')
<div class="register">
    <h2 class="register__title">Register</h2>
    <div class="register__form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="register__form-group">
                <label for="name" class="register__label">お名前</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="register__input" placeholder="例: 山田 太郎" required>
                @error('name')
                    <p class="register__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="register__form-group">
                <label for="email" class="register__label">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="register__input" placeholder="例: test@example.com" required>
                @error('email')
                    <p class="register__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="register__form-group">
                <label for="password" class="register__label">パスワード</label>
                <input id="password" type="password" name="password" class="register__input" placeholder="例: coachtech1106" required>
                @error('password')
                    <p class="register__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="register__button-container">
                <button type="submit" class="register__button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
