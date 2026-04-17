<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\ProjectExperiencesController;
use App\Services\ProjectService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('project')->group(function () {
    Route::get('/show-project', [ProjectExperiencesController::class, 'index']);
    Route::post('/create-project', [ProjectExperiencesController::class, 'createProject']);
});

