<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('beneficiarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre_beneficiario',128);
			$table->string('primer_apellido_beneficiario',128);
			$table->string('segundo_apellido_beneficiario',128);
			$table->string('clave_electoral',128);
			$table->string('secc_electoral',128);
			$table->integer('num_int');
			$table->integer('num_ext');
			$table->string('colinia',128);
			$table->integer('cp');
			$table->string('tel_casa',128);
			$table->string('tel_cel',128);
			$table->string('email',128);
			$table->string('comentario',128);

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
		Schema::drop('beneficiarios');
	}

}
