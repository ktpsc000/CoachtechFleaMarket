@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')

@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/addresses/address.css')}}">
@endsection

@section('content')


<div class="address-form">
    <h2 class="address-form__heading content__heading">住所の変更</h2>
    <div class="address-form__inner">
        <form class="address-form__form" action="/purchase/{{$item->id}}" method="post">
            @csrf
            <div class="address-form__group">
                <label for="postal_code" class="address-form__label">郵便番号</label>
                <input class="address-form__input" type="number" name="postal_code" id="postal_code">
            </div>
            <div class="address-form__group">
                <label for="address" class="address-form__label">住所</label>
                <input class="address-form__input" type="text" name="address" id="address">
            </div>
            <div class="address-form__group">
                <label for="building" class="address-form__label">建物名</label>
                <input class="address-form__input" type="text" name="building" id="building">
            </div>
            <input class="address-form__btn" type="submit" value="更新する">
        </form>
    </div>
</div>

@endsection

@endsection