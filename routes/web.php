<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('app');
});


Route::get('/tasks', [TaskController::class, 'getTasks']);

Route::post('/tasks', [TaskController::class, 'store']);
Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);