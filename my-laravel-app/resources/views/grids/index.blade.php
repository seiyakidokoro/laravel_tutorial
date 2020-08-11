@extends('layouts.application')

@section('content')
    <div class="container">
        <header class="header">
            <div class="company-logo">SOL's Store</div>
            <ul class="header-nav">
                <li class="header-nav-item">TOP</li>
                <li class="header-nav-item">COMPANY</li>
                <li class="header-nav-item">CONTACT</li>
            </ul>
        </header>
        <div style="text-align: center">
            <img width="320" src="/img/sol.png" alt="">
        </div>
        <div class="main">
            <div class="product-name">
                <span>No1</span>
                <p>うまい棒</p>
            </div>
            <div class="product-photo">
                <img src="https://placehold.jp/450x450.png" alt="">
            </div>
            <div class="product-lineup">
                <img src="https://placehold.jp/100x100.png" alt="">
                <img src="https://placehold.jp/100x100.png" alt="">
                <img src="https://placehold.jp/100x100.png" alt="">
            </div>
        </div>
    </div>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
        }

        .container {
            padding: 0 4%;
        }

        /*ヘッダー*/
        .header {
            display: grid;
            grid-template:
                "company-logo header-nav" auto / 30% 1fr;
            padding: 10px 0;
        }

        .company-logo {
            grid-area: company-logo;
        }

        .header-nav {
            grid-area: header-nav;
            display: flex;
            margin-left: auto;
        }

        .header-nav-item {
            margin-left: 12px;
        }

        .main {
            display: grid;
            grid-template:
                "product-name product-name" auto
                "product-photo product-lineup" auto / 1.4fr 1fr
        }

        .product-name{
            grid-area: product-name;
        }

        .product-photo{
            grid-area: product-photo;
        }

        .product-lineup{
            grid-area: product-lineup;
        }
    </style>
@endsection
