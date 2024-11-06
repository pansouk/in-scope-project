<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/login', [SessionController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/{role?}', [UserController::class, 'index']);
        Route::post('/create', [UserController::class, 'create']);
        Route::get('/{uuid}/show', [UserController::class, 'show']);
        Route::put('/{uuid}/update', [UserController::class, 'update']);
        Route::delete('/{uuid}/destroy', [UserController::class, 'destroy']);
    })->middleware(IsAdmin::class);

    Route::group(['prefix' => 'companies'], function(){
        Route::get('/', [CompanyController::class, 'index']);
        Route::post('/create', [CompanyController::class, 'create']);
        Route::get('/{uuid}/show', [CompanyController::class, 'show']);
        Route::put('/{uuid}/update', [CompanyController::class, 'update']);
        Route::delete('/{uuid}/destroy', [CompanyController::class, 'destroy']);
    })->middleware(IsAdmin::class);

    Route::group(['prefix' => 'projects'], function(){
        Route::get('/{type?}', [ProjectController::class, 'index']);
        Route::post('/create', [ProjectController::class, 'create']);
        Route::put('/{uuid}/update', [ProjectController::class, 'update']);
        Route::get('/{uuid}/{type}/show', [ProjectController::class, 'show']);
        Route::delete('/{uuid}/{type}/destroy', [ProjectController::class, 'destroy']);
    })->middleware(IsAdmin::class);
});

