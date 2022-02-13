<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectTagsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('/', [LoginController::class, 'currentUser']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/dashboard', [LoginController::class, 'dashboard']);
        Route::put('/', [LoginController::class, 'updateUser']);
        Route::put('/reset-password', [LoginController::class, 'resetPassword']);
    });
    Route::post('/', [LoginController::class, 'login']);
});

Route::group(['prefix' => 'blogs'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [BlogsController::class, 'create']);
        Route::delete('/{id}', [BlogsController::class, 'delete']);
        Route::put('/{id}', [BlogsController::class, 'update']);
        Route::put('{id}/tags', [TagsController::class, 'update']);
    });
    Route::get('/{id}', [BlogsController::class, 'find']);
    Route::get('/paginate={paginate}/category={category}', [BlogsController::class, 'blogs']);
    Route::get('/slug/{slug}', [BlogsController::class, 'viewBlog']);
});

Route::group(['prefix' => 'tags'], function() {
    Route::post('/', [TagsController::class, 'create']);
});

Route::group(['prefix' => 'projects'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [ProjectsController::class, 'create']);
        Route::delete('/{id}', [ProjectsController::class, 'delete']);
        Route::put('/{id}', [ProjectsController::class, 'update']);
        Route::put('/{id}/project-tags', [ProjectTagsController::class, 'update']);
    });
    Route::get('/{id}', [ProjectsController::class, 'find']);
    Route::get('/limit/{limit}', [ProjectsController::class, 'projects']);
    Route::get('/search/{name}', [ProjectsController::class, 'search']);
    Route::get('/slug/{slug}', [ProjectsController::class, 'viewProject']);
});

Route::group(['prefix' => 'project-tags'], function() {
    Route::post('/', [ProjectTagsController::class, 'create']);
});