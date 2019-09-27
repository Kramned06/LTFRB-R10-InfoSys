<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalibrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('inspector_id')->unsigned()->nullable();
            $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('cascade')->onUpdate('cascade');

            $table->string('sticker_color');
            $table->string('calibration_seq');
            $table->string('calibration_date');
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
        Schema::dropIfExists('calibrations');
    }
}
