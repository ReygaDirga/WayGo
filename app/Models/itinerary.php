<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class itinerary extends Model
{
    protected $table = 'itinerary_lists';
    protected $fillable = [
        'trip_uuid',
        'user_id',
        'location',
        'start_date',
        'end_date',
        'day',
        'date',
        'time',
        'adults',
        'children',
        'destination_name',
        'address',
        'estimated_cost',
        'rating',
        'description',
        'distance_to_next'
    ];
}
