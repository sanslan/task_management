<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('v1/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
});
