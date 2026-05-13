<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectExperiencesController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/update-user', [AuthController::class, 'updateUser']);
    Route::get('/me', [AuthController::class, 'index']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('project')->group(function () {
        Route::get('/show-project', [ProjectExperiencesController::class, 'index']);
        Route::post('/create-project', [ProjectExperiencesController::class, 'createProject']);
        Route::put('/update-project/{id}', [ProjectExperiencesController::class, 'updateProject']);
        Route::delete('/destroy/{id}', [ProjectExperiencesController::class, 'destroy']);
    });
});

Route::group([], function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/work-experiences', [WorkExperienceController::class, 'index']);
    Route::get('/github/contributions', [GithubController::class, 'getContributions']);
    Route::get('/github/user', [GithubController::class, 'getUser']);
});
