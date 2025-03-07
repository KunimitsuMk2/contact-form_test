@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <h2 class="confirm__title">Confirm</h2>
    <table class="confirm__table">
        <tr>
            <th>お名前</th>
            <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if ($contact['gender'] == 1) 男性
                @elseif ($contact['gender'] == 2) 女性
                @else その他
                @endif
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $contact['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $contact['tel'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $contact['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $contact['building'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $contact['category'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ nl2br(e($contact['detail'])) }}</td>
        </tr>
    </table>

    <div class="confirm__buttons">
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
            <input type="hidden" name="email" value="{{ $contact['email'] }}">
            <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
            <input type="hidden" name="address" value="{{ $contact['address'] }}">
            <input type="hidden" name="building" value="{{ $contact['building'] }}">
            <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
            <button type="submit" class="btn btn--submit">送信</button>
        </form>

        <form action="{{ route('contact.edit') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn--edit">修正</button>
        </form>
    </div>
</div>
@endsection
