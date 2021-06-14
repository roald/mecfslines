<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRepeatableToExtend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->foreignId('extend_id')->nullable()->after('status')->constrained('memberships')->onDelete('SET NULL');
            $table->dropColumn('repeatable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->boolean('repeatable')->default(true)->after('status');
            $table->dropForeign(['extend_id']);
            $table->dropColumn('extend_id');
        });
    }
}
