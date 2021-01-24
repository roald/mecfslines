<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->onDelete('RESTRICT')->constrained('pages');
            $table->string('type', 25)->default('page');

            $table->string('title', 100);
            $table->string('slug', 50);
            $table->text('description')->nullable();

            $table->string('status', 25)->default('active');
            $table->integer('order')->default(1);
            $table->boolean('menu')->default(false);

            $table->softDeletes();
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
        Schema::dropIfExists('pages');
    }
}
