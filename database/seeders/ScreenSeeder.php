<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screen;
use App\Models\Movie;
use App\Models\Schedule;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $screens = Screen::with(['schedule' => function ($query) {
        //     $query->whereTime('end_time', '>', now());
        // }])->get();

        Screen::insert([
            'name'=>'スクリーン1',
            'movie_id'=>1,
        ]);

        Screen::insert([
            'name'=>'スクリーン2',
            'movie_id'=>2,
        ]);

        Screen::insert([
            'name'=>'スクリーン3',
            'movie_id'=>4,
        ]);
    }
}
