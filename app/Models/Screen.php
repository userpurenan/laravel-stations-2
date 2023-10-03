<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\Sheet;
use App\Models\Schedule;

class Screen extends Model
{
    use HasFactory;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function sheet() {
        return $this->belongsToMany(Sheet::class);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }

}
