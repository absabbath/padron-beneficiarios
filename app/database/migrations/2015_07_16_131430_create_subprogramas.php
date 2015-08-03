<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubprogramas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subprogramas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre_subprograma',512);
			$table->integer('id_programas')->unsigned();
			$table->timestamps();
			$table->foreign('id_programas')->references('id')->on('programas')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subprogramas');
	}
	

}
