<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task as TaskModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Task extends Controller
{
    public function createTask(CreateTaskRequest $request){
        $newTask = TaskModel::create($request->validated());
        return response()->json(['task' => $newTask], 201);
    }

    public function getTasks(){
        $tasks = TaskModel::all();

        return response()->json(['tasks' => $tasks], 200);
    }

    public function getTasksByStatus(int $status){
        if (!in_array($status, [1, 2, 3])) {
            return response()->json(['error' => 'Invalid status value'], 400);
        }

        $tasks = TaskModel::where('status', $status)->get();
        return response()->json(['tasks' => $tasks], 200);
    }

    public function editTask(int $id, UpdateTaskStatusRequest $request){
        try{
            $task = TaskModel::findOrFail($id);
            $task->update($request->validated());

            return response()->json(['task' => $task], 200);
        } catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Task not found.'], 404);
        }
    }

    public function deleteTask(int $id){
        try {
            $task = TaskModel::findOrFail($id);
            $task->delete();

            return response()->json(['message' => 'Task deleted successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found.'], 404);
        }
    }
}
