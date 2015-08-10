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
			$table->string('segundo_apellido_beneficiario',128)->nullable();
			$table->integer('edad')->nullable()->default(18);
			$table->string('ocupacion',128)->nullable();
			$table->string('sexo',2);
			$table->string('clave_electoral',128)->nullable();
			$table->string('secc_electoral',128)->nullable();
			$table->string('num_int',128)->nullable();
			$table->string('num_ext',128)->nullable();
			$table->string('colonia',256);
			$table->string('calle',256);
			$table->integer('cp')->nullable();
			$table->string('tel_casa',128)->nullable();
			$table->string('tel_cel',128)->nullable();
			$table->string('email',128)->nullable();
			$table->string('comentario',1024)->nullable();

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
