<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('login',64);
			$table->string('email',128);
			$table->string('password',64);
            $table->string('remember_token',100)->nullable();
			$table->string('nombre',250);
			$table->string('primer_apellido',250);
			$table->string('segundo_apellido',250);
			$table->integer('id_rol')->unsigned();
			$table->boolean('estatus')->default(true);
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
		Schema::drop('users');
	}

}
