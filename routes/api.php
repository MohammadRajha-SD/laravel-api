<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'api'

], function ($router) {
    Route::get('/posts',[PostController::class, 'index']);
    Route::get('/posts/{id}',[PostController::class, 'show']);
    Route::post('/posts',[PostController::class, 'store']);
    Route::put('/posts/{id}',[PostController::class, 'update']);
    Route::delete('/posts/{id}',[PostController::class, 'delete']);
});