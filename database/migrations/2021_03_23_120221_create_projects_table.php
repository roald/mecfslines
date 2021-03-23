<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->onDelete('SET NULL')->nullable()->constrained();

            $table->string('title', 190);
            $table->string('slug', 50);
            $table->string('type', 50);
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->date('published_at');
            $table->string('status', 25);

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
        Schema::dropIfExists('projects');
    }
}
