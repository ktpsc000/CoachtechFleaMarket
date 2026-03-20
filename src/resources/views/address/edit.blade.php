@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/address/edit.css')}}">
@endsection

@section('content')

<div class="address-form">
    <h2 class="address-form__heading content__heading">住所の変更</h2>
    <div class="address-form__inner">
        <form class="address-form__form" action="/purchase/address/{{$item->id}}" method="post">
            @method('patch')
            @csrf
            <div class="address-form__group">
                <label for="postal_code" class="address-form__label">郵便番号</label>
                <input class="address-form__input" type="text" name="postal_code" id="postal_code" value="{{$address['postal_code']}}">
                <p class="error-message">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="address-form__group">
                <label for="address" class="address-form__label">住所</label>
                <input class="address-form__input" type="text" name="address" id="address" value="{{$address['address']}}">
                <p class="error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="address-form__group">
                <label for="building" class="address-form__label">建物名</label>
                <input class="address-form__input" type="text" name="building" id="building" value="{{$address['building']}}">
                <p class="error-message">
                    @error('building')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="address-form__btn" type="submit" value="更新する">
        </form>
    </div>
</div>

@endsection