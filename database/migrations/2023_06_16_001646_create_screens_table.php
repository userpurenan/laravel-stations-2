<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->text('name')->comment('スクリーン名');

            $table->unsignedBigInteger('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');   
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screens', function (Blueprint $table) {
            $table->dropForeign(['movie_id']);
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['screen_id']);
        });


        Schema::dropIfExists('screens');
    }
}
