<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectExperiencesController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('project')
    ->middleware(EnsureTokenIsValid::class)
    ->group(function () {

        Route::get('/show-project', [ProjectExperiencesController::class, 'index']);
        Route::post('/create-project', [ProjectExperiencesController::class, 'createProject']);
        Route::put('/update-project/{id}', [ProjectExperiencesController::class, 'updateProject']);
        Route::delete('/destroy/{id}', [ProjectExperiencesController::class, 'destroy']);
    });
