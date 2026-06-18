<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'min_price',
        'max_price',
    ];

    public function users(){
        return $this->hasMany(
            User::class
        );
    }
}
