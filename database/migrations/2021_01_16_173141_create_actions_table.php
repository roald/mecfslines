<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->onDelete('CASCADE')->constrained();
            $table->foreignId('page_id')->onDelete('SET NULL')->nullable()->constrained();

            $table->string('type', 25)->default('slug');
            $table->string('action', 100);
            $table->string('target', 255)->nullable();
            $table->integer('order')->default(1);
            $table->string('role', 25)->default('primary');

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
        Schema::dropIfExists('actions');
    }
}
