<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectors', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('franchise_id')->unsigned()->nullable();
            $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('unit_id')->unsigned()->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('operator_id')->unsigned()->nullable();
            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade')->onUpdate('cascade');

            $table->string('sticker_number');
            $table->string('tradename');
            $table->string('year_model');
            $table->text('remarks');
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
        Schema::dropIfExists('inspectors');
    }
}
