<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());
Route::get('/', fn () => [
    'message' => 'Welcome to Location Review API.',
    'by' => 'Muhammad Haikal Al Rasyid | 2107411025 | https://github.com/promecarus',
    'documentation' => 'https://documenter.getpostman.com/view/26179218/2s946o4VA3'
]);
Route::get('/ping', fn () => ['message' => 'pong11']);
Route::post('/register', [UserController::class, 'store']);
Route::post(
    '/login',
    fn () => (Auth::attempt(request()->only('email', 'password')))
        ? [
            'token' => Auth::user()->createToken('auth_token')->plainTextToken
        ]
        : [
            'message' => 'The provided credentials are incorrect.'
        ]
);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('users', UserController::class);
    Route::post('/logout', fn () => Auth::user()->tokens()->delete());
});
Route::group(['prefix' => 'noauth'], function () {
    Route::get('/', fn () => [
        'message' => 'Welcome to Location Review API.',
        'by' => 'Muhammad Haikal Al Rasyid | 2107411025 | https://github.com/promecarus',
        'documentation' => 'https://documenter.getpostman.com/view/26179218/2s946o4VA3'
    ]);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('users', UserController::class);
    Route::get('/ping', fn () => ['message' => 'pong']);
});
