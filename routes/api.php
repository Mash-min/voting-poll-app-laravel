<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PollsController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/', [UsersController::class, 'user']);
    });
});

Route::group(['prefix' => 'polls'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [PollsController::class, 'create']);
        Route::delete('/{id}', [PollsController::class, 'delete']);
        Route::put('/{id}', [PollsController::class, 'update']);
        Route::get('/{id}', [PollsController::class, 'find']);
        Route::get('/', [PollsController::class, 'polls']);
        Route::get('/search/{data}', [PollsController::class, 'search']);
    });
});

Route::group(['prefix' => 'items'], function () {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [ItemsController::class, 'create']);
        Route::delete('/{id}', [ItemsController::class, 'delete']);
        Route::put('/{id}', [ItemsController::class, 'update']);
    });
});

Route::group(['prefix' => 'votes'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [VotesController::class, 'create']);
        Route::put('/{id}', [VotesController::class, 'update']);
    });
});