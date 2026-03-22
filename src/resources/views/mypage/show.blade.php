@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage/show.css')}}">
@endsection

@section('content')
<p class="test">プロフィール画面</p>
<p>購入した商品</p>

@foreach ($items as $item)
<div class="item-card">

    <div class="item-card__img">
        <a href="/item/{{$item->item->id}}">
            <img src="{{$item->item->image_path}}" alt="商品画像">
        </a>
    </div>

    <div class="item-card__name">
        {{$item->item->name}}
    </div>
</div>
@endforeach

@endsection