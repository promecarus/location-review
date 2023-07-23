<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());
Route::get('/', fn () => ['message' => 'Welcome to Location Review API.']);
Route::get('/ping', fn () => ['message' => 'pong']);

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

Route::post('/register', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('users', UserController::class);
});
