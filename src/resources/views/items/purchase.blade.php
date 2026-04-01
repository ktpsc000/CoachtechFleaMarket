@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/purchase.css')}}">
@endsection

@section('js')
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection

@section('content')

<div class="purchase-content">
    <form class="purchase-form" action="/purchase/{{$item->id}}" method="post">
        @csrf
        <div class="purchase__left">

            <div class="purchase__item">
                <div class="purchase__item-image">
                    <img src="{{$item->image_url}}" alt="商品画像">
                </div>
                <div class="purchase__item-detail">
                    <h3 class="purchase__item-name">商品名</h3>
                    <p class="purchase__item-price">￥<span>{{number_format($item->price)}}</span></p>
                </div>
            </div>

            <div class="purchase__payment">
                <h4 class="purchase__payment-title">支払い方法</h4>
                <select class="purchase__payment-select" name="payment_method" id="payment-method-select" required>
                    <option value="" hidden selected>選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>
                <p class="error-message">
                    @error('payment_method')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="purchase__address">
                <div class="purchase__address-header">
                    <h4 class="purchase__address-title">配送先</h4>
                    <a href="/purchase/address/{{$item->id}}" class="purchase__address-change">変更する</a>
                </div>
                <div class="purchase__address-detail">
                    <p class="purchase__address-postal_code">〒 {{$purchase['postal_code']}}</p>
                    <p class=" purchase__address-address">{{$purchase['address']}}</p>
                    <p class="purchase__address-building">{{$purchase['building']}}</p>
                </div>

                @if($errors->has('purchase.postal_code') || $errors->has('purchase.address'))
                <p class="error-message">配送先を入力してください</p>
                @endif
            </div>

        </div>


        <div class=" purchase__right">
            <table class="purchase__summary">
                <tr class="purchase__summary-row">
                    <th class="purchase__summary-label">商品代金</th>
                    <td class="purchase__summary-value">￥<span>{{number_format($item->price)}}</span></td>
                </tr>

                <tr class="purchase__summary-row">
                    <th class="purchase__summary-label">支払い方法</th>
                    <td class="purchase__summary-value" id="payment-method-view">{{old('payment_method', $purchase['payment_method'])}}</td>
                </tr>
            </table>

            <button class="purchase__summary-button">購入する</button>
        </div>
    </form>
</div>

@endsection