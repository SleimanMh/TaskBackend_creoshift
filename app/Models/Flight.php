<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 
        'departure_city',
        'arrival_city', 
        'departure_time', 
        'arrival_time',
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['number'] ?? false) {
            $query->where('number', 'like', '%' . $filters['number'] . '%');
        }
    }
    
    /** @return \Illuminate\Database\Eloquent\Relations\HasMany */
    public function passengers()
    {
        return $this->hasMany(Passenger::class,'flight_id');
    }

   
}
