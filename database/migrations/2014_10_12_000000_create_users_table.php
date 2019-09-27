<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('parent_id')->unsigned()->default(0);

            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('surname');

            $table->string('street')->nullable();;
            $table->string('barangay')->nullable();;
            $table->string('city')->nullable();;
            $table->integer('state')->nullable();;
            $table->integer('country')->nullable();;
            $table->string('postal_code')->nullable();;
            $table->string('contact_number')->nullable();
            $table->string('contact_number_two')->nullable();
            $table->integer('role')->unsigned()->default(0);  ///// role 1 (admin) 2 (inspector) 3 (franchise) 4 (registration)
            // $table->text('access')->nullable();
            $table->enum('status',['off','on'])->default('off');
            $table->string('avatar')->default('user.png');
            $table->string('avatar_size')->nullable();
            
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
