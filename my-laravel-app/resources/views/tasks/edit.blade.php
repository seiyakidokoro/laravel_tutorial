@extends('layouts.application')

@section('content')
    <div class="container">
        <h2 style="text-align: center">TODOリスト</h2>

        <section class="container">
            <form action="{{ url('/task/edit')}}" method="post">
                {{csrf_field()}}
                <label for="update-task">タスクを編集します</label>
                <input type='hidden' name='id' value='{{ $task->id }}'><br>
                <div class="form-group">
                    <input name="title" class="form-control" value="{{ $task->title }}">
                </div>
                <button type="submit" class="btn btn-primary">変更する</button>
            </form>
        </section>
@endsection
