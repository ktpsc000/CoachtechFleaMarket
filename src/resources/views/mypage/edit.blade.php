@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage/edit.css')}}">
@endsection


@section('content')

<div class="profile-content">
    <h2 class="profile__heading content__heading">プロフィール設定</h2>
    <div class="profile-image">
        <img class="profile-image__image" src="{{$profile->image_path}}" alt="">
        <a class="profile-image__change-link" href="/mypage/profile">画像を選択する</a>
    </div>
    <div class="profile-form">
        <div class="profile-form__inner">
            <form class="profile-form__form" action="/mypage" method="post">
                @csrf
                <div class="profile-form__group">
                    <label for="name" class="profile-form__label">ユーザー名</label>
                    <input class="profile-form__input" type="text" name="name" id="name" value="{{old('name',$profile->name)}}">
                    <p class="error-message">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="profile-form__group">
                    <label for="postal_code" class="profile-form__label">郵便番号</label>
                    <input class="profile-form__input" type="text" name="postal_code" id="postal_code" value="{{old('postal_code',$profile->postal_code)}}">
                    <p class="error-message">
                        @error('postal_code')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="profile-form__group">
                    <label for="address" class="profile-form__label">住所</label>
                    <input class="profile-form__input" type="text" name="address" id="address" value="{{old('address',$profile->address)}}">
                    <p class="error-message">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="profile-form__group">
                    <label for="building" class="profile-form__label">建物名</label>
                    <input class="profile-form__input" type="text" name="building" id="building" value="{{old('building',$profile->building)}}">
                    <p class="error-message">
                        @error('building')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <input class="profile-form__btn" type="submit" value="更新する">
            </form>
        </div>
    </div>
</div>
@endsection