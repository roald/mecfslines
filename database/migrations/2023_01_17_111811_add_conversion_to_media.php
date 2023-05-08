<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AddConversionToMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->unique()->after('model_id');
            $table->string('conversions_disk')->nullable()->after('disk');
        });

        Media::cursor()->each(
            fn (Media $media) => $media->update(['uuid' => Str::uuid(), 'conversions_disk' => $media->disk])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('uuid', 'conversions_disk');
        });
    }
}
