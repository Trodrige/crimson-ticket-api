<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id')->comment = "Primary key";
            $table->string('firstname', 255)->comment = "The traveler's firstname.";
            $table->string('lastname', 255)->comment = "The traveler's lastname.";
            $table->string('phone', 255)->comment = "The traveler's phone number.";
            $table->string('cni', 255)->comment = "The traveler's national id card.";
            $table->integer('seat')->comment = "The traveler's seat number.";
            $table->integer('journey_id')->unsigned()->comment = "The traveler's journey";

            $table->foreign('journey_id')->references('id')->on('journeys')->onDelete('cascade');

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
        Schema::table('transactions', function (Blueprint $table) {
            Schema::dropIfExists('transactions');
        });
    }
}
