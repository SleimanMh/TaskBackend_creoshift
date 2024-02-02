<?php

namespace App\Http\Controllers\Api;

use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::latest()->filter(request(['FirstName', 'LastName']))->paginate();
        return response()->json($passengers);
    }

    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
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

        return response()->json(['message' => 'Passenger created successfully', 'data' => $passenger]);
    }

    public function update(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);

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

        return response()->json(['message' => 'Passenger updated successfully', 'data' => $passenger]);
    }

    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->flights()->detach(); 
        $passenger->delete();

        return response()->json(['message' => 'Passenger deleted successfully']);
    }
}
