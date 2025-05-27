<?php

namespace App\Http\Controllers;

use App\Models\Task as TaskModel;
use Illuminate\Http\Request;

class Task extends Controller
{
    public function createTask(Request $request){
        $task = $request->all();
        $newTask = TaskModel::create($task);

        return response()->json(['task' => $newTask], 201);
    }
}
