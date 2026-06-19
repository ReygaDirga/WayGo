<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PulauBlog extends Model
{
    protected $table = 'pulau_blog'; 

    // Kasih tau kolom apa aja yang ada (selain id)
    protected $fillable = ['nama'];
}
