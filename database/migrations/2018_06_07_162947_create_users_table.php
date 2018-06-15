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
            $table->increments('id')->comment = "Primary key";
            $table->string('firstname', 255)->comment = "The admin's firstname.";
            $table->string('lastname', 255)->comment = "The admin's lastname.";
            $table->string('username', 255)->unique()->comment = "The administrator's username";
            $table->string('password')->unique()->comment = "The admin's password.";
            $table->string('role', 255)->default('admin')->comment = "The admin's role.";

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
