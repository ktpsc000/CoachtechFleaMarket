@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/auth/register.css')}}">
@endsection

@section('content')


<div class="register-form">
    <h2 class="register-form__heading content__heading">会員登録</h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/register" method="post">
            @csrf
            <div class="register-form__group">
                <label for="name" class="register-form__label">ユーザー名</label>
                <input class="register-form__input" type="text" name="name" id="name">
            </div>
            <div class="register-form__group">
                <label for="email" class="register-form__label">メールアドレス</label>
                <input class="register-form__input" type="email" name="email" id="email">
            </div>
            <div class="register-form__group">
                <label for="password" class="register-form__label">パスワード</label>
                <input class="register-form__input" type="password" name="password" id="password">
            </div>
            <div class="register-form__group">
                <label for="password_confirmation" class="register-form__label">確認用パスワード</label>
                <input class="register-form__input" type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <input class="register-form__btn" type="submit" value="登録する">
        </form>
    </div>
    <a href="/login" class="register-page__login-link">ログインはこちら</a>
</div>

@endsection