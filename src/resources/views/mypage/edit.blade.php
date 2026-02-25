@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/auth/profile.css')}}">
@endsection

@section('content')


<div class="profile-form">
    <h2 class="profile-form__heading content__heading">プロフィール編集</h2>
    <div class="profile-form__inner">
        <form class="profile-form__form" action="/mypage" method="post">
            @csrf
            <div class="profile-form__group">
                <label for="name" class="profile-form__label">ユーザー名</label>
                <input class="profile-form__input" type="text" name="name" id="name">
            </div>
            <div class="profile-form__group">
                <label for="postal_code" class="profile-form__label">郵便番号</label>
                <input class="profile-form__input" type="number" name="postal_code" id="postal_code">
            </div>
            <div class="profile-form__group">
                <label for="address" class="profile-form__label">住所</label>
                <input class="profile-form__input" type="text" name="address" id="address">
            </div>
            <div class="profile-form__group">
                <label for="building" class="profile-form__label">建物名</label>
                <input class="profile-form__input" type="text" name="building" id="building">
            </div>
            <input class="profile-form__btn" type="submit" value="更新する">
        </form>
    </div>
</div>

@endsection