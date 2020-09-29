@extends('layouts.application')
@section('content')
    <div class="container">

        <a href="{{ url('manager/product/new') }}">
            <button>新規作成</button>
        </a>

        @isset($products)
            <table>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ asset('/storage/img/'.$product->image) }}" style="width:100px"><br>
                            <a href="{{ url('manager/product/'.$product->id.'/edit') }}">
                                <button  type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
                            </a>
                            <a href="{{ url('manager/product/'.$product->id.'/delete') }}">
                                <button  type="button" class="btn-danger"><i class="far fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endisset

    </div>

@endsection
