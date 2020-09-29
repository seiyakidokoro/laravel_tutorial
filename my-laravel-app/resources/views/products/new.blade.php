@extends('layouts.application')
@section('content')
    <div class="container">

        <!-- エラーメッセージエリア -->
        @if ($errors->any())
            <p>エラーがあります</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

{{--        htmlのformタグを使う方法、larevelにはFormファサードというものを使う方法もある--}}
        <form action="{{ url('/manager/product')}}" method="POST" enctype="multipart/form-data">
            名前:<br>
            <input name="name">
            <br>
            コメント:<br>
            <textarea name="description" rows="4" cols="40"></textarea>
            <br>
            ポイント:<br>
            <input type="radio" name="point" value="10" checked>10
            <input type="radio" name="point" value="20">20
            <input type="radio" name="point" value="30">30
            <br>
            画像1:<br>
            <input type="file" name="image"><br>
            画像2:<br>
            <input type="file" name="image2"><br>
            画像3:<br>
            <input type="file" name="image3">
            {{ csrf_field() }}
            <br>
            <button class="btn btn-success"> 送信 </button>
        </form>

    </div>

@endsection
