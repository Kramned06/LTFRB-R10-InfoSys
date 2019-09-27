<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('franchise_id')->unsigned()->nullable();
            $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade')->onUpdate('cascade');
            $table->string('motor_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->integer('year_confirmed')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('make')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('units');
    }
}
