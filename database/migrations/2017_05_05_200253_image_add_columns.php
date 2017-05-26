<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImageAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function ($table) {
            $table->integer('image_id')->nullable(true)->unsigned();
            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::table('students', function ($table) {
            $table->integer('image_id')->nullable(true)->unsigned();
            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::table('employees', function ($table) {
            $table->integer('image_id')->nullable(true)->unsigned();
            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    
        Schema::table('events', function ($table) {
            $table->integer('image_id')->nullable(true)->unsigned();
            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::table('tests', function ($table) {
            $table->integer('image_id')->nullable(true)->unsigned();
            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::table('patrimonies', function ($table) {
            $table->integer('image_id')->nullable(true)->unsigned();
            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('cascade');
        });
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
