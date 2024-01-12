<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'FirstName',
        'LastName',
        'email',
        'password',
        'DOB',
        'passport_expiry_date',
    ];
}
