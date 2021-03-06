<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('nota');
			$table->integer('test_id')->nullable(true)->unsigned();
			$table->foreign('test_id')->references('id')->on('tests')
				->onUpdate('cascade')->onDelete('cascade');
			$table->integer('student_id')->nullable(true)->unsigned();
			$table->foreign('student_id')->references('id')->on('students')
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
		Schema::dropIfExists('notations');
	}
}
