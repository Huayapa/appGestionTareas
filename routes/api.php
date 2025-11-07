<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.api')->group(function () {
    // CERRAR SESIÓN
    Route::post('/logout', [ProfileController::class, 'logout']);
    // CRUD USUARIO
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::get('/users/{id}', [UserController::class, 'getUser']);
    Route::post('/users', [UserController::class, 'create']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    // CRUD TAREA
    Route::get('/tasks', [TaskController::class, 'getTasks']);
    Route::get('/taskuser/{userId}', [TaskController::class, 'getTasksUser']);
    Route::get('/tasks/{id}', [TaskController::class, 'getTask']);
    Route::post('/tasks', [TaskController::class, 'create']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});

Route::post('/register', [ProfileController::class, 'register']);
Route::post('/login', [ProfileController::class, 'login']);
