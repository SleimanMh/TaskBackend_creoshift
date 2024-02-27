<?php

namespace App\Http\Controllers\Api;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Symfony\Component\HttpFoundation\Response;

class PassengerController extends Controller
{
    public function index()
    {
        $seconds = 60 * 60; // Cache for 1 hour
        $users = Cache::remember('passengers', $seconds, function () {
        return DB::table('passengers')->get();
        });

        $passengers = QueryBuilder::for(Passenger::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                'FirstName',
                'LastName',
                AllowedFilter::exact('number'),
                'flights.id'
            ])
            ->allowedSorts(['FirstName', 'LastName', 'created_at'])
            ->paginate(request()->input('per_page', 10));
        return response(['success' => true, 'data' => $passengers]);
    }

    public function show(Passenger $passenger)
    {
        return response(['success' => true, 'data' => $passenger]);
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

        return response(['success' => true, 'data' => $passenger]);
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

        return response(['success' => true, 'data' => $passenger]);
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->flights()->detach(); 
        $passenger->delete();

        return response(['data' => $passenger], Response::HTTP_NO_CONTENT);
    }

}
