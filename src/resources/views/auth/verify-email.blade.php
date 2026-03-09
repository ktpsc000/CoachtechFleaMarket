@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/auth/verify-email.css')}}">
@endsection

@section('content')

<div class="verify-content">
    <p class="verify-text">登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。</p>
    <a class="verify-link" href="http://localhost:8025">認証画面はこちらから</a>

    <form class="verify-form" method="POST" action="/email/verification-notification">
        @csrf
        <button type="submit">認証メールを再送する</button>
    </form>
</div>

@endsection