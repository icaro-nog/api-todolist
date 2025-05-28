<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/task', [TaskController::class, 'createTask']);

Route::get('tasks', [TaskController::class, 'getTasks']);

Route::get('tasks/status/{status}', [TaskController::class, 'getTasksByStatus']);

Route::put('task/{id}', [TaskController::class, 'editTask']);

Route::delete('task/{id}', [TaskController::class, 'deleteTask']);