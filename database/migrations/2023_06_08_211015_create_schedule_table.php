<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time')->default(NULL)->comment('上映開始時刻');
            $table->dateTime('end_time')->default(NULL)->comment('上映終了時刻');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *s
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);
        });

        Schema::dropIfExists('schedules');
    }
}
