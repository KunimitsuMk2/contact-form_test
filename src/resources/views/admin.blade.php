@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')
<div class="admin-container">
    <h2 class="admin-title">Admin</h2>
    
<form action="{{ url('/admin/search') }}" method="GET" class="search-area">
        <input type="text" name="search_name" placeholder="名前やメールアドレスを入力してください" class="search-input">
        <input type="text" name="search_email" placeholder="メールアドレス" class="search-input">
        
        <select name="search_gender" class="search-select">
            <option>性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>
        
        <select name="search_category" class="search-select">
            <option>お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        
        <input type="date" name="search_date" class="search-date">
        
        <button type="submit" class="search-button">検索</button>
        <button type="reset" class="reset-button">リセット</button>
    </form>
     <form action="{{ url('/admin/export') }}" method="get">
    <button class="export-button">エクスポート</button>
    </form>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender == 1) 男性 @elseif($contact->gender == 2) 女性 @else その他 @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td><button class="detail-button">詳細</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- ページネーション -->
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
    @if(session('contact'))
    <div class="modal" style="display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">お問い合わせ詳細</h5>
                <!-- モーダルを閉じるボタン -->
                <button type="button" class="close" onclick="window.location='{{ route('admin.index') }}'">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>お名前:</strong> {{ session('contact')['first_name'] }} {{ session('contact')['last_name'] }}</p>
                <p><strong>性別:</strong> {{ session('contact')['gender'] }}</p>
                <p><strong>メールアドレス:</strong> {{ session('contact')['email'] }}</p>
                <p><strong>お問い合わせの種類:</strong> {{ session('contact')['category'] }}</p>
                <p><strong>お問い合わせ内容:</strong> {{ session('contact')['detail'] }}</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.contact.delete', session('contact')['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('admin.index') }}'">閉じる</button>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection