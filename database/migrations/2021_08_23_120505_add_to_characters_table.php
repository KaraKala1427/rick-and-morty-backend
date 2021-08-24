<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->foreignId('birth_location_id')
                ->nullable()
                ->after('image_id')
                ->constrained('locations')
                ->onDelete('restrict');
            $table->foreignId('current_location_id')
                ->nullable()
                ->after('birth_location_id')
                ->constrained('locations')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropForeign(['birth_location_id','current_location_id']);
            $table->dropIndex(['birth_location_id','current_location_id']);
            $table->dropColumn(['birth_location_id','current_location_id']);
        });
    }
}
