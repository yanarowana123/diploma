<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->float('temp');
            $table->float('temp_feels_like');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('visibility');
            $table->string('title');
            $table->string('description');
            $table->string('icon');
            $table->float('wind_speed');
            $table->integer('wind_direction');
            $table->foreignId('city_id')->constrained();
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
        Schema::dropIfExists('weather');
    }
}
