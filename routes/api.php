<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\UserController;

Route::post('/users/register', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['cache.response','throttle:api'])->group(function () {
Route::middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Admin dashboard']);
    });    
    Route::apiResource('/users', UserController::class)->except(['store']); 
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/export', [UserController::class, 'export']);
    Route::apiResource('/passengers', PassengerController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/flights', FlightController::class);
});
});