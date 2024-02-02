<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    // app/Models/Flight.php
    protected $guarded = ['id', 'created_at', 'updated_at'];

    
    public function scopeFilter($query, array $filters)
    {
        if ($filters['number'] ?? false) {
            $query->where('number', 'like', '%' . $filters['number'] . '%');
        }
    }
    
    /** @return \Illuminate\Database\Eloquent\Relations\HasMany */
    public function passengers()
    {
        return $this->belongsToMany(Passenger::class);
    }
}
