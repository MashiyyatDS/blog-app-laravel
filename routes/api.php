<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectTagsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
    Route::post('/', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::group(['prefix' => 'blogs'], function() {
    // Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [BlogsController::class, 'create']);
        Route::delete('/{id}', [BlogsController::class, 'delete']);
        Route::put('/{id}', [BlogsController::class, 'update']);
        Route::get('/{id}', [BlogsController::class, 'find']);
    // });
    Route::get('/', [BlogsController::class, 'blogs']);
});

Route::group(['prefix' => 'tags'], function() {
    Route::post('/', [TagsController::class, 'create']);
});

Route::group(['prefix' => 'projects'], function() {
    Route::post('/', [ProjectsController::class, 'create']);
    Route::delete('/{id}', [ProjectsController::class, 'delete']);
    Route::put('/{id}', [ProjectsController::class, 'update']);
    Route::get('/{id}', [ProjectsController::class, 'find']);
    Route::get('/', [ProjectsController::class, 'projects']);
});

Route::group(['prefix' => 'project-tags'], function() {
    Route::post('/', [ProjectTagsController::class, 'create']);
});