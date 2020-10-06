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
        <nav class="footerNav">
            <div class="footerNav_tab">
                <button class="footerNav_btn">ポイント1</button>
                <button class="footerNav_btn active">ポイント2</button>
                <button class="footerNav_btn">ポイント3</button>
            </div>
            <p class="footerNav_info">
                吾輩 （ わがはい ） は猫である。名前はまだ無い。 どこで生れたかとんと 見当 （ けんとう ） がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。吾輩はここで始めて人間というものを見た。しかもあと ...
            </p>
        </nav>
    </div>

@endsection
