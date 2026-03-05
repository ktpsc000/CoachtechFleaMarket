@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{asset('css/items/index.css')}}">
@endsection

@section('content')

<p class="test">商品一覧画面</p>

@if($contacts['gender'] == 1) 男性
@elseif($contacts['gender'] == 2) 女性
@else その他
@endif

@endsection