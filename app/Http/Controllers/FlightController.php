<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    //
    public function index()
    {
        return view('flights.index', [
            'flights' => Flight::latest()->filter((request(['number'])))->paginate()
        ]);
    }

    public function showPassengers($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        $passengers = $flight->passengers;

        return view('flights.showPassengers',[
            'passengers'=>$passengers
        ]);
    }
}
