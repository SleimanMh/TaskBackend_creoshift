<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    //
    public function index()
    {
        $flights = QueryBuilder::for(Flight::class)
            ->allowedFilters([
                AllowedFilter::partial('number'),
            ])
            ->allowedSorts(['number', 'created_at'])
            ->paginate(request()->input('per_page', 10));
    
        return response(['success' => true, 'data' =>$flights]);
    }

    public function show(Flight $flight)
    {
        return response(['success' => true, 'data' => $flight]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            'departure_city' => 'required|string',
            'arrival_city' => 'required|string',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
        ]);

        $flight = Flight::create($request->all());

        return response()(['success' => true, 'data' => $flight]);
    }
    
    public function update(Request $request, Flight $flight)
    {
        $request->validate([
            'number' => 'required|integer',
            'departure_city' => 'required|string',
            'arrival_city' => 'required|string',
            'departure_time' => 'required|date',
            'arrival_time' => 'nullable|date|after:departure_time',
        ]);

        $flight->update($request->all());

        return response()->json(['success' => true, 'data' => $flight]);
    }
    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->json(['success' => true]);
    }

}
