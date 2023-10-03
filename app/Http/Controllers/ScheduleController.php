<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Requests\CreateScheduleRequest;
use Carbon\CarbonImmutable;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function UserDetail($id)  //詳細画面表示用メソッド
    {
        $now = CarbonImmutable::now();
        $movie = Movie::findOrFail($id);

        $tomorrow = $now->addDay()->format('m-d');

        foreach($movie->schedules as $schedule)
        {
            if($schedule->start_time < $now && $tomorrow !== $schedule->start_time->format('m-d'))
            {
                $schedule->start_time = $schedule->start_time->addDay();
                $schedule->end_time = $schedule->end_time->addDay();
                $schedule->save();
            }
        }

        $schedules = Schedule::where('movie_id' , $id )->oldest('start_time')->get();

        
        return view('UserDitail', compact('movie', 'schedules' , 'now'));
    }


    public function detail($id)  //管理者詳細画面表示用メソッド
    {
        $now = CarbonImmutable::now();
        $movie = Movie::findOrFail($id);

        $tomorrow = $now->addDay()->format('m-d');

        foreach($movie->schedules as $schedule)
        {
            if($schedule->start_time < $now && $tomorrow !== $schedule->start_time->format('m-d'))
            {
                $schedule->start_time = $schedule->start_time->addDay();
                $schedule->end_time = $schedule->end_time->addDay();
                $schedule->save();
            }
        }

        $schedules = Schedule::where('movie_id' , $id )->oldest('start_time')->get();

        return view('detailMovie', compact('movie', 'schedules'));
    }

    public function detailer($id)  //詳細管理画面表示用メソッド
    {
        $movie = Movie::findOrFail($id);
        $schedules = Schedule::where('movie_id', $id)->get();       
        return view('scheduleTableView', compact('movie', 'schedules'));

    }

    public function scheduleShow()    //スケジュール表表示
    {
        $schedules = Schedule::all();
        return view('ShowSchedule', compact('schedules'));

    }

    public function schedule()    //今日のスケジュール一覧表示メソッド
    {
        $movie = Movie::all();
        $schedules = Schedule::all();
        return view('movieschedule',compact('schedules','movie') );
    }



    public function CreateSchedule($movie_id)    //スケジュール登録画面表示メソッド
    {
        return view('createSchedule' , compact('movie_id'));
    }


    public function Schedulestore(CreateScheduleRequest $request , $movie_id)  //スケジュール登録処理メソッド
    {
            DB::beginTransaction();
        try 
        {              
            Schedule::insert([
                'movie_id' => $movie_id,
                'start_time' => $request->input('start_time_date') . ' ' . $request->input('start_time_time'),
                'end_time' => $request->input('end_time_date') . ' ' . $request->input('end_time_time'),
            ]);         
            
            DB::commit();
    
            return redirect()->route('movies.schedule')->with('success', 'スケジュールが登録されました');
        } catch (\Exception $e) 
        {
            DB::rollBack();

            return redirect()->route('movies.CreateSchedule',['id'=>$movie->id])->with('error', 'エラーが発生しました');
        }
    }


    public function ScheduleUpdateform($scheduleId)   //スケジュール更新画面表示用メソッド
    {
        $schedule = Schedule::findOrFail($scheduleId);
        return view('ScheduleEditMovie', compact('schedule'));
    }


    public function ScheduleUpdate(UpdateScheduleRequest $request, $id)   //スケジュール更新処理用メソッド
    {        
        DB::beginTransaction();

        try
        {
            $schedule = Schedule::findOrFail($id)
                            ->update([
                                'movie_id' => $request->input('movie_id'),
                                'start_time' => $request->input('start_time_date') . ' ' . $request->input('start_time_time'),
                                'end_time' => $request->input('end_time_date') . ' ' . $request->input('end_time_time'),                
                            ]);

            DB::commit();

            return redirect()->route('movies.schedule')->with('success','スケジュールの更新が成功しました');
        }catch (\Exception $e) 
        {
            DB::rollBack();

            return redirect()->back()->with('error', 'エラーが発生しました');
        }    
    }

    public function deleteSchedule( $scheduleId) //スケジュール削除メソッド
    {
        Schedule::findOrFail($scheduleId)->forceDelete();

        return redirect()->route('movies.schedule')->with('flash_message', 'スケジュールの削除に成功しました');
    }
}
