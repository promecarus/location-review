<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'message' => 'Welcome to the Location Review API.'
        ]);
    });
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('users', UserController::class);
});
