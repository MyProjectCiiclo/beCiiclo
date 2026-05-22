<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/update-user', [AuthController::class, 'updateUser']);
    });
});

Route::prefix('project')->group(function () {
    Route::get('/show-project', [ProjectController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create-project', [ProjectController::class, 'createProject']);
        Route::put('/update-project/{id}', [ProjectController::class, 'updateProject']);
        Route::delete('/destroy/{id}', [ProjectController::class, 'destroy']);
    });
});

Route::group([], function () {
    Route::get('/profile', [ProfileController::class, 'index']);

    Route::get('/contact/list', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/contact/destroy/{id}', [ContactController::class, 'destroy']);
        Route::put('/profile/update', [ProfileController::class, 'updateProfile']);
    });
    Route::get('/work-experiences', [WorkExperienceController::class, 'index']);
    Route::get('/github/contributions', [GithubController::class, 'getContributions']);
    Route::get('/github/user', [GithubController::class, 'getUser']);
});


Route::prefix('cv')->group(function () {
    Route::get('/show-cv', [CvController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create-cv', [CvController::class, 'uploadCv']);
        Route::put('/update-cv/{id}', [CvController::class, 'updateCv']);
        Route::delete('/destroy/{id}', [CvController::class, 'destroy']);
    });
});


Route::prefix('educations')->group(function () {
    Route::get('/show-educations', [EducationController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {


        Route::post('/create-educations', [EducationController::class, 'store']);

        Route::put('/update-educations/{id}', [EducationController::class, 'update']);

        Route::delete('/destroy/{id}', [EducationController::class, 'destroy']);
    });
});

Route::prefix('courses')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create-courses', [CourseController::class, 'store']);
        Route::put('/update-courses/{id}', [CourseController::class, 'update']);
        Route::delete('/destroy/{id}', [CourseController::class, 'destroy']);
    });
});



Route::get('/ratings', [RatingController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/ratings/{id}', [RatingController::class, 'destroy']);
});
