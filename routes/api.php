<?php

use App\Http\Controllers\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('task', [Task::class, 'createTask']);

Route::get('tasks', [Task::class, 'getTasks']);

Route::get('tasks/status/{status}', [Task::class, 'getTasksByStatus']);