<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->nullable()->onDelete('SET NULL')->constrained();

            $table->string('name', 100);
            $table->string('slug', 50);
            $table->text('description')->nullable();
            $table->decimal('price', 5, 2);
            $table->string('type', 25);
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
        Schema::dropIfExists('products');
    }
}
