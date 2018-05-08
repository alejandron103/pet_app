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
            $table->string('name');
            $table->unsignedTinyInteger('age');
            $table->string('email')->unique();
            $table->string('gender', 1);
            $table->string('description')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('breed_id');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('restrict');
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
