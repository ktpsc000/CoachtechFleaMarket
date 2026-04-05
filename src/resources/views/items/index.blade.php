@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')
<div class="items-content">
    <div class="items-tabs">
        <a href="/?keyword={{ request('keyword')}}" class="items-tabs__recommend {{ $tab !== 'mylist' ? 'active' : '' }}">おすすめ</a>
        <a href="/?tab=mylist&keyword={{ request('keyword')}}" class="items-tabs__mylist {{ $tab === 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>
    <div class="items-list">
        @foreach ($items as $item)
        <div class="item-card">

            <div class="item-card__img {{ $item->isSold() ? 'is-sold' : ''}}">
                <a href="/item/{{$item->id}}">
                    <img src="{{$item->image_url}}" alt="商品画像">
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