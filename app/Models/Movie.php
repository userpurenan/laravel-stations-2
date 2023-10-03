<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\Models\Reservation;
use App\Models\Screen;

class Movie extends Model
{
    protected $fillable = ['title','image_url','published_year','is_showing','description','genre_id'];
    protected $guarded = ['created_at', 'updated_at'];


    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class );
    }

    public function screen()
    {
        return $this->hasOne(Screen::class);
    }


    use HasFactory;
}
