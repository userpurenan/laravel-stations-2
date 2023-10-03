<?php

namespace Database\Seeders;

use Database\Seeders\ScheduleSeeder;
use Database\Seeders\GenreSeeder;
use Database\Seeders\MovieSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\Movie_ScheduleSeeder;

class MovieListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenreSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ScreenSeeder::class);
        $this->call(SheetSeeder::class);
    }
}
