@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')
<div class="items-content">
    <div class="items-tabs">
        <a href="/" class="item-tabs__tab">おすすめ</a>
        <a href="/?tab=mylist" class="item-tabs__tab">マイリスト</a>
    </div>
    <div class="items-list">
        @foreach ($items as $item)
        <div class="items-card">
            <div class="item-card__img">
                <img src="{{$item->image_path}}" alt="商品画像">
            </div>
            <div class="items-card__name">
                {{$item->name}}
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection