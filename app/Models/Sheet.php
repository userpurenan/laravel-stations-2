<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Screen;

class Sheet extends Model
{

    public function reservation()
    {  
         return $this->hasMany(Reservation::class);
    }  
    
    public function screen() {
        return $this->belongsToMany(Screen::class);
    }

    use HasFactory;
}
