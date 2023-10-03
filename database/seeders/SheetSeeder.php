<?php

namespace Database\Seeders;

use App\Models\Sheet;
use Illuminate\Database\Seeder;

class SheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sheet::insert
        ([
            ['row' => 'A', 'column' => 1],
            ['row' => 'A', 'column' => 2],
            ['row' => 'A', 'column' => 3],
            ['row' => 'A', 'column' => 4],
            ['row' => 'A', 'column' => 5],
            ['row' => 'B', 'column' => 1],
            ['row' => 'B', 'column' => 2],
            ['row' => 'B', 'column' => 3],
            ['row' => 'B', 'column' => 4],
            ['row' => 'B', 'column' => 5],
            ['row' => 'C', 'column' => 1],
            ['row' => 'C', 'column' => 2],
            ['row' => 'C', 'column' => 3],
            ['row' => 'C', 'column' => 4],
            ['row' => 'C', 'column' => 5],
        ]); 

    }
}