<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id')->comment = "Primary key";
            $table->string('car_num')->comment = "Car number";
            $table->boolean('type')->default(0)->comment = "Type of car. 0 == Prestige, 1 == VIP";
            $table->integer('num_of_seats')->default(70)->comment = "Number of seats in each car";
            $table->integer('user_id')->unsigned()->comment = "Admin who created this car";

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::table('cars', function (Blueprint $table) {
            Schema::dropIfExists('cars');
        });
    }
}
