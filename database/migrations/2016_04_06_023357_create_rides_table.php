<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id')->unsigned()->index();
            $table->string('title');
            $table->integer('seats_available')->default(1);
            $table->string('departure_city')->nullable();
            $table->integer('departure_state')->nullable();
            $table->time('departure_time')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('arrival_city')->nullable();
            $table->integer('arrival_state')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rides');
    }
}
