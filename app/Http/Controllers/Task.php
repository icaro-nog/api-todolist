<?php

namespace App\Http\Controllers;

use App\Models\Task as TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Task extends Controller
{
    public function createTask(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'status' => 'integer|between:1,3',
            'description' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $newTask = TaskModel::create($validated);

        return response()->json(['task' => $newTask], 201);
    }

    public function getTasks(){
        $tasks = TaskModel::all();

        return response()->json(['tasks' => $tasks], 200);
    }

    public function getTasksByStatus(int $status){
        $tasks = TaskModel::where('status', $status)->get();

        return response()->json(['tasks' => $tasks], 200);
    }
}
