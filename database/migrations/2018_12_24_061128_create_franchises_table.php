
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::create('franchises', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('operator_id')->unsigned()->nullable();
            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('case_number')->nullable();
            $table->string('business_address')->nullable();
            $table->date('date_granted')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('route_name')->nullable();
            $table->string('deno')->nullable();
            $table->integer('authorize_units')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 022639 061028 // 2018_12_24_061128 units 2018_12_30_ 061028 franchise
     * 2018_12_24_061128 units 2018_12_30_ 061028 franchise
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchises');
    }
}
