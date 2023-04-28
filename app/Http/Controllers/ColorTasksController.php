<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexColorTasksResource;
use App\Models\TaskColor;
use Illuminate\Http\Request;

class ColorTasksController extends Controller
{
    public function index()
    {
        return IndexColorTasksResource::collection(TaskColor::all());
    }
}
