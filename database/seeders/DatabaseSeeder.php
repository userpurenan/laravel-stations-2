<?php

namespace Database\Seeders;

use App\Models\Practice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Practice::factory(10)->create();
    }
}
