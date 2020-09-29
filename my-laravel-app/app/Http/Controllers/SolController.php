<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class SolController extends Controller
{
    public function index()
    {
        return view('sols.index');
    }
}
