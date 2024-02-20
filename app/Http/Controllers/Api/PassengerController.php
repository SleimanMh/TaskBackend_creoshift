<?php

namespace App\Http\Controllers\Api;

use App\Models\Passenger;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = QueryBuilder::for(Passenger::class)
            ->allowedFilters([
                AllowedFilter::partial('FirstName'),
                AllowedFilter::partial('LastName'),
            ])
            ->allowedSorts(['FirstName', 'LastName', 'created_at'])
            ->paginate();
    
        return response()->json($passengers);
    }

    public function show(Passenger $passenger)
    {
        return response()->json($passenger);
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers|max:255',
            'password' => 'required|string|min:6',
            'DOB' => 'required|date',
            'passport_expiry_date' => 'required|date',
            'flight_ids' => 'array|exists:flights,ids',
        ]);

        $passenger = Passenger::create($request->all());
        $passenger->flights()->sync($request->input('flight_ids', []));

        return response()(['success' => true, 'data' => $passenger]);
    }

    public function update(Request $request,Passenger $passenger)
    {

        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email,' . $passenger->id,
            'password' => 'required|string|min:6',
            'DOB' => 'required|date',
            'passport_expiry_date' => 'required|date',
            'flight_ids' => 'array|exists:flights,id',
        ]);

        $passenger->update($request->all());
        $passenger->flights()->sync($request->input('flight_ids', []));

        return response()->json(['success' => true, 'data' => $passenger]);
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->flights()->detach(); 
        $passenger->delete();

        return response()->json(['success' => true]);
    }
}
