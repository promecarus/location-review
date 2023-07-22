<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

Route::fallback(function () {
    return response()->json([
        'message' => 'Requested resource not found.'
    ], 404);
});
