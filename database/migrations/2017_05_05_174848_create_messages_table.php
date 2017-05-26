<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->integer('message_id')->unsigned()->nullable(true);
            $table->integer('user_send')->unsigned();
            $table->integer('user_receiver')->unsigned();
            $table->foreign('message_id')->references('id')->on('messages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_send')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_receiver')->references('id')->on('users')
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
        Schema::dropIfExists('messages');
    }
}
