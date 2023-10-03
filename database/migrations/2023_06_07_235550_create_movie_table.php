<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) 
        {
            $table->id();
            $table->string('title', 200)->unique('employees_employee_id_unique_idx');        
            $table->text('image_url')->comment('画像URL');
            $table->integer('published_year')->default(0)->comment('公開年');
            $table->boolean('is_showing')->default(false)->comment('上映中かどうか');
            $table->text('description')->nullable()->comment('概要');
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
        Schema::dropIfExists('movies');
    }

}  
 
