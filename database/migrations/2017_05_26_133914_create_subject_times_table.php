<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->string('half');
            $table->boolean('situation');
            $table->integer('teacher_id')->unsigned();
            $table->integer('teacher2_id')->nullable(true)->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher2_id')->references('id')->on('teachers')
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
        Schema::dropIfExists('subject_times');
    }
}
