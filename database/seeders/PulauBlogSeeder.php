<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PulauBlogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pulau_blog')->insert([
            ['name' => 'Sumatra'],
            ['name' => 'Java'],
            ['name' => 'Bali & Nustra'],
            ['name' => 'Kalimantan'],
            ['name' => 'Sulawesi'],
            ['name' => 'Maluku'],
            ['name' => 'Papua'],
        ]);
    }
}