<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practices', function (Blueprint $table) {
            $table->id();
            $table->text('title')->comment('タイトル');
            $table->timestamps();
        });


        // Schema::create('movies', function (Blueprint $table) {
        //     $table->id();
        //     $table->text('title')->comment('タイトル');
        //     //$table->text('img_url')->comment('画像URL');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practices');
    }
}
