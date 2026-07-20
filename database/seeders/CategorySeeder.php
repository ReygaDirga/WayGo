<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Culture',
                'description' => 'Experience the rich culture and traditions of every destination.',
                'icon' => 'fa-solid fa-landmark',
                'image' => 'assets/jakarta.jpg',
            ],
            [
                'name' => 'Nature',
                'description' => 'Discover stunning beaches, lush forests, majestic mountains, and breathtaking landscapes.',
                'icon' => 'fa-solid fa-tree',
                'image' => 'assets/hutan.jpeg',
            ],
            [
                'name' => 'Culinary',
                'description' => 'Discover the unique flavors of Indonesian cuisine from every region.',
                'icon' => 'fa-solid fa-utensils',
                'image' => 'assets/kuliner.png',
            ],
            [
                'name' => 'Adventure',
                'description' => 'Feel the thrill of exciting outdoor adventures, from hiking to rafting.',
                'icon' => 'fa-solid fa-mountain-sun',
                'image' => 'assets/rinjani.jpg',
            ],
        ]);
    }
}