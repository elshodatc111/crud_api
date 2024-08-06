<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; 

Route::get('/user', function (Request $request) {
    
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/create', [TaskController::class, 'create']);
Route::put('/update/{id}', [TaskController::class, 'update']);
Route::get('/task', [TaskController::class, 'all']);
Route::get('/task/show/{id}', [TaskController::class, 'show']);