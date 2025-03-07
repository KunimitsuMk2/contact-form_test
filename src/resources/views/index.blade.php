@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="contact-container">
    <h1 class="contact-title">Contact</h1>
    <form action="{{route('contact.confirm')}}" method="POST" class="contact-form">
        @csrf
        <div class="form-group">
            <label for="last_name">お名前 <span class="required">*</span></label>
            <div class="name-inputs">
                <input type="text" id="last_name" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" required>
                @error('last_name')
                <span class="error">{{ $message }}</span>
                @enderror

                <input type="text" id="first_name" name="first_name" placeholder="例: 太郎"
                value="{{ old('first_name') }}" required>
                @error('first_name')
                <span class="error">{{ $message }}</span>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label>性別 <span class="required">*</span></label>
            <div class="gender-options">
            <input type="radio" id="male" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
            <label for="male">男性</label>
            <input type="radio" id="female" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
            <label for="female">女性</label>
            <input type="radio" id="other" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
            <label for="other">その他</label>
            @error('gender')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス <span class="required">*</span></label>
            <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" required>
        @error('email')
        <span class="error">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="tel">電話番号 <span class="required">*</span></label>
            <div class="tel-inputs">
                <input type="text" name="tel1" maxlength="4" placeholder="080" required>
                <span>-</span>
                <input type="text" name="tel2" maxlength="4" placeholder="1234" required>
                <span>-</span>
                <input type="text" name="tel3" maxlength="4" placeholder="5678" required>
                @error('tel')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">住所 <span class="required">*</span></label>
            <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required>
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" id="building" name="building" value="{{ old('building') }}">
        @error('building')
        <span class="error">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="category">お問い合わせの種類 <span class="required">*</span></label>
            <select id="category" name="category_id" required>
                <option value="">選択してください</option>
                <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品交換について</option>
            <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
        </select>
        @error('category_id')
        <span class="error">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="detail">お問い合わせ内容 <span class="required">*</span></label>
            <textarea id="detail" name="detail" placeholder="お問い合わせ内容をご記載ください" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-button">確認画面</button>
        </div>
    </form>
</div>
@endsection
