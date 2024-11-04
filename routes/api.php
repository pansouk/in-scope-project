<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/login', [SessionController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'users'], function () {
        Route::post('/create', [UserController::class, 'create'])->middleware(IsAdmin::class);
        Route::get('/{uuid}/show', [UserController::class, 'show'])->middleware(IsAdmin::class);
        Route::post('/{uuid}/show', [UserController::class, 'update'])->middleware(IsAdmin::class);
    });
});

