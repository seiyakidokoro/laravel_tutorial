@extends('layouts.application')

@section('content')
{{--    {{ auth()->user()->name }}--}}
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
        <div id="app" class="main">
            <div class="productName">
                 <span class="productHead">No{% product_detail.id %}{% product_detail.name %}</span>
                <p>{% product_detail.description %}</p>
            </div>
            <div class="productPhoto">
                <img :src="slider_img">
            </div>
            <div class="product-lineup">
                <img v-for="product in products" class="product-lineup-item" :src="product.slider_images[0]" :key="product.id" @click="get_product_detail(product.id)">
            </div>
            <div class="circle">
                <span class="circle_item" :class="{'active': isActive == 0}" @click="get_slider_image(0)"></span>
                <span class="circle_item" :class="{'active': isActive == 1}" @click="get_slider_image(1)"></span>
                <span class="circle_item" :class="{'active': isActive == 2}" @click="get_slider_image(2)"></span>
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
    <script>
        new Vue({
            el: '#app',
            delimiters: ['{%', '%}'],
            data: {
                products: {},
                product_detail: '',
                slider_img: '',
                isActive: 0
            },
            mounted:function(){
                axios.get('/api/get_products').then(res => {
                    // 全ての商品を取得
                    this.products = res.data

                    // 最初の商品を取得
                    if (res.data)
                    {
                        const first_key = Object.keys(res.data)[0];
                        this.product_detail = res.data[first_key]
                        this.slider_img = res.data[first_key]['slider_images'][0]
                    }
                });
            },
            methods:{
                get_product_detail:function(product_id){
                    this.product_detail = this.products[product_id]
                    this.slider_img = this.products[product_id]['slider_images'][0]
                },
                get_slider_image:function(index){
                    this.slider_img = this.product_detail['slider_images'][index]
                    this.isActive = index
                }
            }
        })
    </script>
@endsection
