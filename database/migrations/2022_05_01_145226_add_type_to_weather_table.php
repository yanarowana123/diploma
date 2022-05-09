<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0);
            $table->float('temp_feels_like')->nullable()->change();
            $table->integer('pressure')->nullable()->change();
            $table->integer('humidity')->nullable()->change();
            $table->integer('visibility')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('icon')->nullable()->change();
            $table->float('wind_speed')->nullable()->change();
            $table->integer('wind_direction')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather', function (Blueprint $table) {
            //
        });
    }
}
