<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rosters', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('weekday');
            $table->time('start_time');
            $table->time('end_time');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();

            $table->string('title', 190);
            $table->string('type', 50);
            $table->string('url', 255)->nullable();
            $table->text('description')->nullable();

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
        Schema::dropIfExists('rosters');
    }
}
