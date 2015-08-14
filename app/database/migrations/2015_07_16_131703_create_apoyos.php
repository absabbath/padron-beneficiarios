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
			$table->double('monto',7,4);
			$table->dateTime('fecha');
			$table->string('concepto', 1024);
			$table->enum('periodicidad', array('Un solo pago','Quincenal', 'Mensual','Bimestral,','Semestral','Anual','Otro'));
			$table->integer('id_tipo_apoyos')->unsigned();			
			$table->integer('id_beneficiarios')->unsigned();
			$table->integer('id_subprogramas')->unsigned();
			$table->timestamps();
			$table->foreign('id_tipo_apoyos')->references('id')->on('tipo_apoyos')->onDelete('cascade');
			$table->foreign('id_beneficiarios')->references('id')->on('beneficiarios')->onDelete('cascade');
			$table->foreign('id_subprogramas')->references('id')->on('subprogramas')->onDelete('cascade');

			
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
