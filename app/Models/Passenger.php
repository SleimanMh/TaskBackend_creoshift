<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'FirstName',
        'LastName',
        'email',
        'password',
        'DOB',
        'passport_expiry_date',
        'flight_id',
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['FirstName'] ?? false) {
            $query->where('FirstName', 'like', '%' . $filters['FirstName'] . '%');
        }
    }


    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }
}
