<?php

use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassengerController;

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

Route::get('/', function () {
    return view('passengers.index');
});
Route::get('/passengers', [PassengerController::class, 'index']);

Route::get('/flights', [FlightController::class, 'index']);

Route::get('/flights/{flight}/passengers', [FlightController::class,'showPassengers'])->name('flights.showPassengers');