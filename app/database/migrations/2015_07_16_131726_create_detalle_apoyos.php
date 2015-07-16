<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleApoyos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('detalle_apoyos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_tipo_apoyos')->unsigned();
			$table->integer('id_apoyos')->unsigned();
			$table->integer('id_subprogramas')->unsigned();
			$table->timestamps();
			$table->foreign('id_tipo_apoyos')->references('id')->on('tipo_apoyos')->onDelete('cascade');
			$table->foreign('id_apoyos')->references('id')->on('apoyos')->onDelete('cascade');
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
		Schema::drop('detalle_apoyos');
	}

}
