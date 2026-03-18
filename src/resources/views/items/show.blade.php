@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/show.css')}}">
@endsection

@section('content')

<div class="show-content">

    <div class="show-image">
        <img src="{{$item->image_path}}" alt="商品画像">
    </div>
    <div class="show-info">

        <h1 class="show-info__name">{{$item->name}}</h1>
        <p class="show-info__brand">{{$item->brand}}</p>
        <p class="show-info__price">￥<span>{{number_format($item->price)}}</span>（税込）</p>

        <div class="show-info__items">
            <form class="show-info__items-favorite" action="/item/{{$item->id}}/favorite" method="post">
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
            <p class="show-info__description-text">{{$item->description}}</p>
        </div>

        <div class="show-info__detail">
            <h2 class="show-info__title">商品の情報</h2>

            <div class="show-info__category">
                <p class="show-info__category-title">カテゴリー</p>
                <div class="show-info__category-list">
                    @foreach($item->categories as $category)
                    <span class="show-info__category-name">{{$category->name}}</span>
                    @endforeach
                </div>
            </div>

            <div class="show-info__condition">
                <p class="show-info__condition-title">商品の状態</p>
                <span class="show-info__condition-text">{{$item->condition_text}}</span>
            </div>

        </div>

        <div class="show-info__comment">
            <h2 class="show-info__comment-title">コメント({{ $item->comments_count }})</h2>

            @foreach($item->comments as $comment )
            <div class="show-info__comment-list">
                <div class="show-info__comment-user">
                    <img src="" alt="">
                    <p>{{$comment->user->profile->name}}</p>
                </div>
                <p class="show-info__comment-text">{{$comment->content}}</p>
            </div>
            @endforeach

            <div class="show-info__comment-store">
                <h3>商品へのコメント</h3>
                <form action="/item/{{$item->id}}" method="post">
                    @csrf
                    <textarea class="show-info__comment-store--textarea" name="content"></textarea>
                    <p class="error-message">
                        @error('content')
                        {{ $message }}
                        @enderror
                    </p>
                    <button class="show-info__comment-store--submit" type="submit">コメントを送信する</button>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection