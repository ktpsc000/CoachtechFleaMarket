@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')
<div class="items-content">
    <div class="item-tabs">
        <a href="/" class="item-tabs__tab">おすすめ</a>
        <a href="/?tab=mylist" class="item-tabs__tab">マイリスト</a>
    </div>
    <div class="item-list">
        @foreach
        
        @endforeach
    </div>
</div>

@endsection