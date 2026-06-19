<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'user_id',
        'title',
        'location',
        'image',
        'content',
        'best_time_visit', 
        'estimated_cost', 
        'tips',
        'id_pulau'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pulau()
    {
        return $this->belongsTo(PulauBlog::class, 'id_pulau');
    }
}
