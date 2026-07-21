<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('budgets')->insert([
            [
                'name' => 'Low',
                'min_price' => 0,
                'max_price' => 2000000,
            ],
            [
                'name' => 'Medium',
                'min_price' => 2000000,
                'max_price' => 5000000,
            ],
            [
                'name' => 'High',
                'min_price' => 5000000,
                'max_price' => null,
            ],
        ]);
    }
}