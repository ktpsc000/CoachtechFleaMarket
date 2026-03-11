@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')

<div class="show-content">

    <div class="show-image">
        <img src="{{$item->image_path}}" alt="商品画像">
    </div>
    <div clss="show-info">
        <h1 class="show-info__name">{{$item->name}}</h1>
        <p class="show-info__brand">{{$item->brand}}</p>
        <p class="show-info__price">￥<span>{{$item->price}}</span>税込み</p>
        <div class="show-info__items">
            <div class="show-info__items-favorite">
                <img src="{{asset('storage/ハートロゴ_デフォルト.png')}}" alt="お気に入り">
                <p>77</p>
            </div>
            <div class="show-info__items-comment">
                <img src="{{asset('storage/ふきだしロゴ.png')}}" alt="コメント">
                <p>99</p>
            </div>
        </div>
        <a class="show-info__purchase" href="/purchase/{{$item->id}}">購入手続きへ</a>
        <h2 class="show-info__nav">商品説明</h2>
        <p class="show-info__description">{{$item->description}}</p>
        <h2 class="show-info__nav">商品の情報</h2>
        @foreach($item->categories as $category)
        <p class="show-info__category">{{$category->name}}</p>
        @endforeach
        <p class="show-info__condition">{{$item->condition}}</p>
    </div>

</div>

@endsection