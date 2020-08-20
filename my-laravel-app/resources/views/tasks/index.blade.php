@extends('layouts.application')
@section('content')
    <style>
        .wrapper{
            display: grid;
            grid-template-columns: 3fr 7fr
        }
        .btn {
            display: block;
            margin-bottom: 20px;
        }
    </style>

    <div id="app" class="container">
        <h2 style="text-align: center">TODOリスト</h2>
        <div class="wrapper">
            <div class="side">
                @foreach ($tasks as $task)
                    <button v-on:click=getTask("{{$task->id}}") class="btn">{{ $task->title  }}</button>
                @endforeach
            </div>
            <div id="task">
                (% task_detail  %)
            </div>
        </div>
    </div>
    <script>
        new Vue({
            el: '#app',
            delimiters: ["(%","%)"] ,
            data: {
                number: 0,
                task_detail: 'この値を変更する',
                task_details: []
            },
            methods: {
                getTask: function (task_id) {
                    this.task_detail = this.task_details[0].title


                    // axios.post('/api/',{
                    //     params: {
                    //         // ここにクエリパラメータを指定する
                    //         id: task_id
                    //     }
                    // }).then(res => {
                    //     this.task_detail = res.data['title']
                    // });
                }
            },
            mounted(){
                axios.post('/api/all').then(res => {
                    this.task_details = res.data
                });
            }
        })
    </script>
@endsection
