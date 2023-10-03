<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\Models\Sheet;

class Reservation extends Model
{
    
    public function schedules()
    {
        return $this->belongsTo(Schedule::class , 'schedule_id' );
    }
    
    public function sheet()
    {
        return $this->belongsTo(Sheet::class , 'sheet_id' );
    }
    
    use HasFactory;
}
