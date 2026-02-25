@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/auth/verify-email.css')}}">
@endsection

@section('content')

<a href="http://localhost:8025">認証画面へ</a>

<form method="POST" action="/email/verification-notification">
    @csrf
    <button type="submit">認証メールを再送する</button>
</form>

@endsection