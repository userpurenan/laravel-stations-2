<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidatorServiceProvider implements Rule
{


    /**
     * バリデーション判定
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $request = request()->all();
    
        // H:iのフォーマットで解析できる場合
        if (preg_match('/^\d{1,2}:\d{1,2}$/', $request['start_time_time'])) {
            $start_time = Carbon::createFromFormat('H:i', $request['start_time_time']);
            $end_time = Carbon::createFromFormat('H:i', $request['end_time_time'] );

        }
    
        // H時i分のフォーマットで解析できる場合
        if (preg_match('/^\d{1,2}時\d{1,2}分$/', $request['start_time_time'])) {
            $start_time = Carbon::createFromFormat('H時i分', $request['start_time_time']);
            $end_time = Carbon::createFromFormat('H時i分', $request['end_time_time'] );
        }
        
        // 差が5分未満の場合、バリデーションエラーとする
        if ($start_time->diffInMinutes($end_time) <= 5) {
            return false;
        }   
            return true;
    }

    /**
     * エラーの場合出力するメッセ―ジ
     *
     * @return string
     */
    public function message()
    {
        return '開始時間と終了時間の差は５分以内で設定してください';
    }
}
