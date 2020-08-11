<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class GridController extends Controller
{
    public function index()
    {
        return view('grids.index');
    }
}
