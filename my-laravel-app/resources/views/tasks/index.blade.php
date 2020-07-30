@extends('layouts.application')

@section('content')
    <div class="container">
        <h2 style="text-align: center">TODOリスト</h2>

        <section class="container">
            <form action='{{ url('/task')}}' method="post">
                {{csrf_field()}}
                <label for="add-task">タスクを追加します</label>
                <div class="form-group">
                    <input id="add-task" name="title" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">追加する</button>
            </form>
        </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>
                            <a href="{{ url('task/'.$task->id.'/show') }}">{{ $task->title }}</a>
                        </td>
                        <td>
                            <form action="{{ url('task/'.$task->id.'/edit')  }}">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            <div>
                                <form action="{{ url('task/'.$task->id. '/delete') }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .container {
            padding: 2rem 0;
        }
    </style>
@endsection
