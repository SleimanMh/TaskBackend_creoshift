<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\PassengerController;

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    // Routes that require admin role
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Admin dashboard']); // Adjust as needed
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/passengers', [PassengerController::class, 'index']);
    Route::get('/passengers/{passenger}', [PassengerController::class, 'show']);
    Route::apiResource('/passengers', PassengerController::class);
});

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/flights', [FlightController::class, 'index']);
    Route::get('/flights/{flightId}/passengers', [FlightController::class, 'show']);