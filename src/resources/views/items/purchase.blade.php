@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/purchase.css')}}">
@endsection

@section('content')

<div class="purchase-content">

    <div class="purchase__left">

        <div class="purchase__item">
            <div class="purchase__item-image">
                <img src="{{$item->image_path}}" alt="商品画像">
            </div>
            <div class="purchase__item-detail">
                <h2 class="purchase__item-name">商品名</h2>
                <p class="purchase__price">{{$item->price}}</p>
            </div>
        </div>

        <div class="purchase__payment">
            <p class="purchase__payment-title">支払い方法</p>
            <select class="purchase__payment-select">
                <option value="">選択してください</option>
                <option value="コンビニ払い">コンビニ払い</option>
                <option value="カード払い">カード払い</option>
            </select>
        </div>

        <div class="purchase__address">
            <div class="purchase__address-header">
                <p class="purchase__address-title">配送先</p>
                <a href="/purchase/address/{{$item->id}}" class="purchase__address-change">変更する</a>
            </div>
            <div class="purchase__address-detail">
                <p class="purchase__address-postal_code">〒 {{ substr($address['postal_code'],0,3) }}-{{ substr($address['postal_code'],3,4) }}</p>
                <p class=" purchase__address-address">{{ $address['address'] }}</p>
                <p class="purchase__address-building">{{ $address['building'] }}</p>
            </div>
        </div>

    </div>

    <div class=" purchase__right">
                <div class="purchase__summary">
                    <p class="purchase__price">{{$item->price}}</p>
                    <p class="purchase__payment-method">{{$item->order->payment_method}}</p>
                </div>

                <button class="purchase__button">購入する</button>
            </div>

        </div>

        @endsection