<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{
    //
    public function index()
    {
        return response()->json(Flight::latest()->filter((request(['number'])))->paginate());
    }

    public function showPassengers($flightId)
    {
        return response()->json(Flight::findOrFail($flightId)->passengers);
    }
}
