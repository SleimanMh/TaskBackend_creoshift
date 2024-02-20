<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\Controller;

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
            ->paginate();
    
        return response()->json($flights);
    }

    public function show(Flight $flight)
    {
        return response()->json($flight);
    }
}
