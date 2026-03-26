@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage/edit.css')}}">
@endsection


@section('content')

<div class="profile">
    <h2 class="profile__heading content__heading">プロフィール設定</h2>
    <form class="profile-form" action="/mypage" method="post" enctype="multipart/form-data">
        @csrf
        <div class="profile-image">
            <img class="profile-image__image" src="{{asset('storage/' . $profile->image_path)}}" alt="">
            <div class="profile-image__actions">
                <label class="profile-image__label">
                    画像を選択する
                    <input class="profile-image__input" type="file" name="image">
                </label>
                <p class="error-message profile-image__error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class=" profile-detail">
            <div class="profile-detail__group">
                <label for="name" class="profile-detail__label">ユーザー名</label>
                <input class="profile-detail__input" type="text" name="name" id="name" value="{{old('name',$profile->name)}}">
                <p class="error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="profile-detail__group">
                <label for="postal_code" class="profile-detail__label">郵便番号</label>
                <input class="profile-detail__input" type="text" name="postal_code" id="postal_code" value="{{old('postal_code',$profile->postal_code)}}">
                <p class="error-message">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="profile-detail__group">
                <label for="address" class="profile-detail__label">住所</label>
                <input class="profile-detail__input" type="text" name="address" id="address" value="{{old('address',$profile->address)}}">
                <p class="error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="profile-detail__group">
                <label for="building" class="profile-detail__label">建物名</label>
                <input class="profile-detail__input" type="text" name="building" id="building" value="{{old('building',$profile->building)}}">
                <p class="error-message">
                    @error('building')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="profile-form__btn" type="submit" value="更新する">
        </div>
    </form>
</div>
@endsection