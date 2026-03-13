@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')

<div class="show-content">

    <div class="show-image">
        <img src="{{$item->image_path}}" alt="商品画像">
    </div>
    <div class="show-info">
        <h1 class="show-info__name">{{$item->name}}</h1>
        <p class="show-info__brand">{{$item->brand}}</p>
        <p class="show-info__price">￥<span>{{$item->price}}</span>税込み</p>
        <div class="show-info__items">


            <form class="show-info__items-favorite" action="/item/{item}/favorite" method="post">
                @csrf
                <button type="submit" class="show-info__items-favorite--button">
                    @if($item->favoriteUsers->contains(auth()->id()))
                    <img src="{{asset('storage/ハートロゴ_ピンク.png')}}" alt="お気に入り">
                    @else
                    <img src="{{asset('storage/ハートロゴ_デフォルト.png')}}" alt="お気に入り">
                    @endif
                </button>
                <p>{{$item->favorite_users_count}}</p>
            </form>

            <div class="show-info__items-comment">
                <img src="{{asset('storage/ふきだしロゴ.png')}}" alt="コメント">
                <p>{{$item->comments_count}}</p>
            </div>
        </div>
        <a class="show-info__purchase" href="/purchase/{{$item->id}}">購入手続きへ</a>

        <div class="show-info__description">
            <h2 class="show-info__title">商品説明</h2>
            <p class="show-info__content">{{$item->description}}</p>
        </div>

        <div class="show-info__detail">
            <h2 class="show-info__title">商品の情報</h2>
            <div class="show-info__content">
                <p class="show-info__content-title">カテゴリー</p>
                @foreach($item->categories as $category)
                <span class="show-info__category">{{$category->name}}</span>
                @endforeach
            </div>
            <div class="show-info__content">
                <p class="show-info__content-title">商品の状態</p>
                <p class="show-info__condition">{{$item->condition_text}}</p>
            </div>

            <div class="show-info__comment">
                <h2 class="show-info__comment-title">コメント({{ $item->comments_count }})</h2>
                <div class="show-info__comment-list">
                    @foreach($item->comments as $comment )
                    <div class="show-info__comment-user">
                        <img src="" alt="プロフィール画像">
                        <p>{{$comment->user->profile->name}}</p>
                    </div>
                    <p>{{$comment->content}}</p>
                    @endforeach
                </div>
                <div class="show-info__comment-create">
                    <h3>商品へのコメント</h3>
                    <form action="/item/{{$item->id}}" method="post">
                        @csrf
                        <input class="show-info__comment-create--input" type="text" name="content">
                        <button class="show-info__comment-create--submit" type="submit">コメントを送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection