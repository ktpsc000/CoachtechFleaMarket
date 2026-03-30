@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/exhibition.css')}}">
@endsection

@section('content')

<div class="exhibition-content">
    <h2 class="exhibition__heading content__heading">商品の出品</h2>
    <div class="item-image">
        <h4 class="item-image__title">商品画像</h4>
        <div class="item-image__actions">
            <label class="item-image__label">
                画像を選択する
                <input class="item-image__input" type="file" name="image" id="imageInput">
            </label>
            <p class="error-message">
                @error('image')
                {{ $message }}
                @enderror
            </p>
        </div>
    </div>

    <div class="item-details">
        <h3 class="item-details__title">商品の詳細</h3>
        <div class="item-details__group">
            <h4 class="item-details__group--title">カテゴリー</h4>
            <div class="item-details__group--content">
                <p>カテゴリーの種類を記載すること</p>
            </div>
        </div>

        <div class="item-details__group">
            <h4 class="item-details__group--title">商品の状態</h4>
            <select name="" id="">
                <option value="">選択してください</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>
        </div>
    </div>

    <div class="item-description">
        <h3 class="item-description__title">商品の詳細</h3>
        <div class="item-description__group">
            <label for="name" class="item-description__label">商品名</label>
            <input class="profile-detail__input" type="text" name="name" id="name" value="{{old('name')}}">
            <p class="error-message">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div class="item-description__group">
            <label for="brand" class="item-description__label">ブラント名</label>
            <input class="profile-detail__input" type="text" name="brand" id="brand" value="{{old('brand')}}">
            <p class="error-message">
                @error('brand')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div class="item-description__group">
            <label for="description" class="item-description__label">商品の説明</label>
            <textarea class="profile-detail__textarea" name="description" id="description"></textarea>
            <p class="error-message">
                @error('description')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div class="item-description__group">
            <label for="price" class="item-description__label">商品価格</label>
            <input name="price" id="price"></input>
            <p class="error-message">
                @error('price')
                {{ $message }}
                @enderror
            </p>
        </div>
    </div>


</div>
@endsection