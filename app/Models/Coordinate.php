<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude'
    ];

    public function scopeGetLastCoordinates($query)
    {
        return $query->where('created_at', '>=', now()->subMinute());
    }
}
