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
			$table->string('nombre_dependencia',512);
			$table->string('nombre_director',512);
			$table->string('primer_apellido',512);
			$table->string('segundo_apellido',512);
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
		Schema::drop('dependencias');
	}

}
