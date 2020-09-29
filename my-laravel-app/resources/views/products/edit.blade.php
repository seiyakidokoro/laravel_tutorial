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

        <form action="{{ url('/manager/product/update')}}" method="POST" enctype="multipart/form-data">
            <input name="id" value="{{ $product->id }}" hidden>
            名前:<br>
            <input name="name" value="{{ $product->name }}">
            <br>
            コメント:<br>
            <textarea name="description" rows="4" cols="40">{{ $product->description }}</textarea>
            <br>
            ポイント:<br>
            <input type="radio" name="point" value="10"  {{ $product->point == "10" ? 'checked' : '' }} >10
            <input type="radio" name="point" value="20"  {{ $product->point == "20" ? 'checked' : '' }} >20
            <input type="radio" name="point" value="30"  {{ $product->point == "30" ? 'checked' : '' }} >30
            <br>
            画像1:<br>
            <img src="{{ asset('/storage/img/'.$product->image) }}" style="width:200px"><br>
            <input type="file" name="image" ><br>
            画像2:<br>
            <img src="{{ asset('/storage/img/'.$product->image2) }}" style="width:200px"><br>
            <input type="file" name="image2" ><br>
            画像3:<br>
            <img src="{{ asset('/storage/img/'.$product->image3) }}" style="width:200px"><br>
            <input type="file" name="image3" >
            {{ csrf_field() }}
            <br>
            <button class="btn btn-success"> 送信 </button>
        </form>
    </div>

@endsection
