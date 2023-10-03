<?php

namespace App\Http\Controllers;

use Carbon\CarbonImmutable;
use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use App\Http\Requests\CreateReservationRequest;

use App\Models\Movie;
use App\Models\Reservation;
use App\Models\Sheet;
use App\Models\Schedule;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function get_sheet(Request $request , $movie_id , $schedule_id) //座席選択画面表示メソッド
    {
        $date = $request->input('date'); //予約する日付
        $Sheets = Sheet::all(); //座席一覧

        $reserver = Reservation::pluck('sheet_id')->toArray();

        $reserve = Reservation::pluck('schedule_id')->toArray();
        $reservation = in_array($schedule_id , $reserve);

        if($date < now()) return redirect()->route('users.detail' , ['id' => $movie_id ])->with('flash_message', '開始時刻が過ぎているので予約できません。');

        if ($date) 
        {
            return view('SheetReserve', compact('Sheets' , 'movie_id' , 'schedule_id' , 'date', 'reserver' ,'reservation' ));
        }else
        {
            return redirect()->back()->withErrors(['error' => '無効なリクエストです'])->setStatusCode(400);
        }
    }

    public function reserve(Request $request , $movie_id , $schedule_id ) //予約画面表示
    {
        $reserver = Reservation::pluck('sheet_id')->toArray();
        $reserve = Reservation::pluck('schedule_id')->toArray();

        $date = $request->query('date');
        $sheet_id = $request->query('sheetId');

        $isReserved = in_array($sheet_id, $reserver);
        $reservation = in_array( $schedule_id , $reserve);
        
        $user = session('user');

        if($isReserved && $reservation )  
            return redirect()->back()->with('flash_message', 'その席は既に予約済みです。');

        if($sheet_id && $date)
        {
            return view('CreateReservation' ,  compact('schedule_id' , 'movie_id' , 'date' ,  'sheet_id', 'user' ));

        }else
        {
            return redirect()->back()->withErrors(['error' => '無効なリクエストです'])->setStatusCode(400);
        }
        
    }


    public function reserve_store(CreateReservationRequest $request) //予約登録処理
    {
        DB::beginTransaction();

        try 
        {   
            Reservation::insert
            ([
                'schedule_id' => $request->input('schedule_id'),
                'sheet_id' => $request->input('sheet_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'date' => $request->input('date'),
            ]);         
            
            DB::commit();
    
            return redirect()->route('reserver')->with('flash_message', '予約が完了しました');
        } catch (\Exception $e) 
        {
            DB::rollBack();

            return redirect()->back()->with('flash_message', 'エラーが発生しました、最初からやり直してください');
        }
    }

    public function showreserver() //予約表表示
    {
        $user = session('user');

        $reservers = Reservation::where('email' , $user->email )->get();
        return view('Reserver' , compact('reservers'));
    }

    public function reserverShow()    //管理者予約表表示
    {
        $reservers = Reservation::with( ['schedules' , 'sheet'] )->get();
        return view('ShowReservation', compact('reservers'));
    }

    public function CreateReserver() //予約追加画面表示
    {
        return view('AdminReservation');
    }

    public function StoreReserver(CreateAdminReservationRequest $request)  //予約追加処理
    {
        DB::beginTransaction();

        try 
        {  
            Reservation::insert
            ([
                'schedule_id' => $request->input('schedule_id'),
                'sheet_id' => $request->input('sheet_id'),
                'date' => $request->input('date'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);         

            DB::commit();
    
            return redirect()->route('reservation')->with('flash_message', '予約を追加しました');
        } catch (\Exception $e) 
        {
            DB::rollBack();

            return redirect()->route('create.reservation')->with('flash_message', 'エラーが発生しました、やり直してください');
        }
    }


    public function EditReserver($id)  //予約編集画面表示
    {
        $reservation = Reservation::findOrFail($id);
        return view('EditReservation', compact('reservation'));
    }

    public function UpdateReserver(UpdateAdminReservationRequest $request , $id)  //予約更新処理
    {
        DB::beginTransaction();

        try
        {
            //↓更新処理
            $reserver = Reservation::findOrFail($id)
                            ->update([
                                'schedule_id' => $request->input('schedule_id'),
                                'sheet_id' => $request->input('sheet_id'),
                                'date' => $request->input('date'),
                                'name' => $request->input('name'),
                                'email' => $request->input('email'),                
                            ]);

            DB::commit();

            return redirect()->route('reservation')->with('flash_message','予約の更新が成功しました');
        }catch (\Exception $e) 
        {
            DB::rollBack();

            return redirect()->back()->with('flash_message','エラーメッセージ：'.$e);
        }    
    }

    public function deleteReserver($id)  //予約削除処理
    {
        Reservation::findOrFail($id)->forceDelete();
        return redirect()->route('reservation')->with('flash_message', '削除に成功しました');
    }  
}
