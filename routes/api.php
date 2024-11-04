<?php

use App\Repositories\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [SessionController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {

    Route::middleware('isAdmin')->group( function () {

    });
});

