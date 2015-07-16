<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependencias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
	public function up()
	{
		Schema::create('dependencias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre_dependencia',128);
			$table->string('nombre_director',128);
			$table->string('primer_apellido',128);
			$table->string('segundo_apellido',128);
			$table->integer('id_usuario')->unsigned();
			$table->timestamps();
			$table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dependencias');
	}

}
