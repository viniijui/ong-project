<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day');
            $table->integer('subject_time_id')->nullable(true)->unsigned();
            $table->foreign('subject_time_id')->references('id')->on('subject_times')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('event_id')->nullable(true)->unsigned();
            $table->foreign('event_id')->references('id')->on('events')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->nullable(true)->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('patrimony_id')->nullable(true)->unsigned();
            $table->foreign('patrimony_id')->references('id')->on('patrimonies')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('reserves');
    }
}
