<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['universe', 'planet','sector','base','microverse']);
            $table->enum('dimension', ['c-137', 'replaced','5-126']);
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('image_id')->index()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict');
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
        Schema::dropIfExists('locations');
    }
}
