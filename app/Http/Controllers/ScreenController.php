<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Screen;
use App\Models\Schedule;

use Carbon\CarbonImmutable;

class ScreenController extends Controller
{
    public function ShowScreen()  //上映スクリーン
    {
        $schedules = Schedule::all();
        $now = CarbonImmutable::now();
        $tomorrow = $now->addDay()->format('m-d');

        $screens = Screen::with(['schedule' => function ($query) use ($now) {
            $query->where('end_time', '>', $now)
                ->where('start_time' , '<=', $now);
        }])->get();

        foreach($schedules as $schedule)
        {
            if($now->hour === 23 && $tomorrow !== $schedule->start_time->format('m-d') )
            {
                $schedule->start_time = $schedule->start_time->addDay();
                $schedule->end_time = $schedule->end_time->addDay();
                $schedule->save();
            }
        }
        return view('Screens' , compact('screens' , 'now' ));
    }
}
