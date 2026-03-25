@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage/show.css')}}">
@endsection

@section('content')

<div class="profile">
    <div class="profile-content">
        <img class="profile-content__image" src="{{$profile->image_path}}" alt="">
        <p class="profile-content__user-name">{{$profile->name}}</p>
    </div>
    <a class="profile__change-link" href="/mypage/profile">プロフィールを編集</a>
</div>

<div class="items-content">
    <div class="items-tabs">
        <a href="/mypage" class="items-tabs__exhibited {{ $tab !== 'purchased' ? 'active' : '' }}">出品した商品</a>
        <a href="/mypage?tab=purchased" class="items-tabs__purchased {{ $tab === 'purchased' ? 'active' : '' }}">購入した商品</a>
    </div>
    <div class="items-list">
        @foreach ($items as $item)
        <div class="item-card">

            <div class="item-card__img">
                <a href="/item/{{$item->id}}">
                    <img src="{{$item->image_path}}" alt="商品画像">
                </a>
                @if($item->isSold())
                <span class="item-card__sold">Sold</span>
                @endif
            </div>

            <div class="item-card__name">
                {{$item->name}}
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection