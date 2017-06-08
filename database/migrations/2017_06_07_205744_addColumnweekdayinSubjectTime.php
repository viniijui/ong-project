<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnweekdayinSubjectTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('subject_times', function ($table) {
			$table->integer('week_day')->nullable(true)->unsigned();
			$table->integer('credit')->nullable(true)->unsigned();
			$table->string('place')->nullable(true)->unsigned();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
