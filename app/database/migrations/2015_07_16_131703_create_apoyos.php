<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApoyos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apoyos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('monto');
			$table->dateTime('fecha',128);
			$table->enum('periodicidad', array('un solo pago','quincenal', 'mensual'.'bimestral,','semestral','anual','otro'));
			$table->integer('id_beneficiarios')->unsigned();
			$table->timestamps();
			$table->foreign('id_beneficiarios')->references('id')->on('beneficiarios')->onDelete('cascade');

			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apoyos');
	}

}
