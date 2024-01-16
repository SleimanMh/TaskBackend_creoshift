<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    //

    public function index(){
        return view('passengers.index',[
            'passengers'=>Passenger::latest()->filter((request(['FirstName'])))->paginate()
        ]);
    }
}
