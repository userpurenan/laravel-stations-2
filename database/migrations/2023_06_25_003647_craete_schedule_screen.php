<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Screen;
use App\Models\Schedule;

class CraeteScheduleScreen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_screen', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Schedule::class)->constrained();
            $table->foreignIdFor(Screen::class)->constrained();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_screen');
    }
}
