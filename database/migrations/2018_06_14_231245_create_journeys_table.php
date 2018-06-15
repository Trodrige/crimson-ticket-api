<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->increments('id')->comment = "Primary key";
            $table->string('departure')->default('Buea')->comment = "The departure location";
            $table->string('destination')->default('Bamenda')->comment = "The destination of the journey";
            $table->string('driver')->default('Perside')->comment = "The person driving this car";
            $table->time('departure_time')->comment = "Departure time of the journey";
            $table->integer('amount')->default(5000)->comment = "Transport fare for the journey";
            $table->date('departure_date')->comment = "Departure date of the journey";
            $table->integer('user_id')->unsigned()->comment = "The admin who created this journey";
            $table->integer('car_id')->unsigned()->comment = "The car for this journey";

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

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
        Schema::table('journeys', function (Blueprint $table) {
            Schema::dropIfExists('journeys');
        });
    }
}
