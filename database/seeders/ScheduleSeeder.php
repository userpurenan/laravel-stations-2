<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        $movies = Movie::all();

        $startTimes = [
            '10:00:00',
            '12:45:00',
            '15:30:00',
            '18:15:00',
            '21:00:00',
        ];

        $endTime = [
            '12:00:00',
            '14:45:00',
            '17:30:00',
            '20:15:00',
            '23:00:00',
        ];

        $i = 0;
        foreach($movies as $movie)
        {
            if($i === 5 ) $i = 0;

            Schedule::Create([
                'start_time'=> $startTimes[$i],
                'end_time'=> $endTime[$i],
                'movie_id' => $movie->id,
            ]);

            $i += 1;

            if($i === 5) $i = 0;

            Schedule::Create([
                'start_time'=> $startTimes[$i],
                'end_time'=> $endTime[$i],
                'movie_id' => $movie->id,
            ]);

            $i += 1;

            if($i === 5) $i = 0;

            Schedule::Create([
                'start_time'=> $startTimes[$i],
                'end_time'=> $endTime[$i],
                'movie_id' => $movie->id,
            ]);

            $i += 1;

            if($i === 5) $i = 0;
        }
        

    }
}
