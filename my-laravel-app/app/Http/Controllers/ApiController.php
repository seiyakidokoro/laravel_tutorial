<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $task = Task::find($request->params['id']);
        return $task;
    }

    public function all()
    {
        $tasks = Task::all();
        return $tasks;
    }

    public function get()
    {
        $base_url = 'http://127.0.0.1:8080/api';
        $json = file_get_contents($base_url, 'JSON_PRETTY_PARTY');
        echo '<pre>';
        print_r($json);
        exit;
    }
}
