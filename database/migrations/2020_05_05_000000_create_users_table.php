<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('id')->autoIncrement();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('phone')->unique()->nullable();
            $table->integer('address_id')->nullable();
            $table->string('gender')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('address_id')->references('id')
                ->on('addresses')
                ->onDelete('cascade');
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
