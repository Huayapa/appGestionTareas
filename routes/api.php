<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.api')->group(function () {
    Route::post('/logout', [ProfileController::class, 'logout']);
});

Route::post('/register', [ProfileController::class, 'register']);
Route::post('/login', [ProfileController::class, 'login']);
