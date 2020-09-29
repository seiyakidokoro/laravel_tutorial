@extends('layouts.application')

@section('content')
    <div class="container">
        <header class="header">
            <div class="companyLogo">SOL's Store</div>
            <ul class="headerNav">
                <li class="headerNav_item"><a href="">TOP</a></li>
                <li class="headerNav_item"><a href="">COMPANY</a></li>
                <li class="headerNav_item"><a href="">CONTACT</a></li>
            </ul>
        </header>
        <div class="logo">
            <img src="/img/sol.png" alt="しずおかオンラインのロゴ画像">
        </div>
        <div class="main">
            <div class="productName">
                 <span class="productHead">No1うまい棒</span>
                <p>うまい棒は、株式会社やおきんが日本で販売している棒状のスナック菓子。</p>
            </div>
            <div class="productPhoto">
                <img src="{{ asset('/img/umai.png') }}" alt="">
            </div>
            <div class="product-lineup">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
                <img class="product-lineup-item" src="https://placehold.jp/100x100.png" alt="">
            </div>
            <div class="circle">
                <span class="circle_item active"></span>
                <span class="circle_item "></span>
                <span class="circle_item "></span>
            </div>
            <div class="buyBtnWrapper">
                <button class="buyBtn">Coinで購入する</button>
            </div>
        </div>
{{--        <div>--}}
{{--            製品情報--}}
{{--            使い方--}}
{{--            お取り扱い店舗--}}
{{--        </div>--}}
    </div>

@endsection
