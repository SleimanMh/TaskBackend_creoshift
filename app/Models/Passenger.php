<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
// app/Models/Passenger.php

    protected $dates = ['deleted_at'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['FirstName'] ?? false) {
            $query->where('FirstName', 'like', '%' . request('FirstName') . '%');
        }
    }

    public function flights()
    {
        return $this->belongsToMany(Flight::class);
    }
}
