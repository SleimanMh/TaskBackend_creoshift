<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
// app/Models/Passenger.php

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function flights()
    {
        return $this->belongsToMany(Flight::class);
    }
}
