<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\UserController;


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Admin dashboard']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::get('/passengers', [PassengerController::class, 'index']);
    Route::get('/passengers/{passenger}', [PassengerController::class, 'show']);
    Route::apiResource('/passengers', PassengerController::class)->except(['index','show']);

    Route::get('/flights', [FlightController::class, 'index']);
    Route::get('/flights/{flight}', [FlightController::class, 'show']);
    Route::post('/flights', [FlightController::class, 'store']);
    Route::post('/flights/{flight}', [FlightController::class, 'update']);
    Route::delete('/flights/{flight}', [FlightController::class, 'destroy']);
});

    

    