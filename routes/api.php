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
        Route::put('/{uuid}/update', [UserController::class, 'update'])->middleware(IsAdmin::class);
        Route::delete('/{uuid}/destroy', [UserController::class, 'destroy'])->middleware(IsAdmin::class);
    });
});

