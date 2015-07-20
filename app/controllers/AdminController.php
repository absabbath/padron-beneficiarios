<?php

class AdminController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }



    /**
     * panelAdmin Funcion para sincronizar datos del archivo excel a la BD
     * @return Redirect Redirecciona a la vista anterior con el mensaje de 
     *                               confirmacion de sincroniacion
     */
    
    public function panelAdmin()
    {

		ini_set("memory_limit","2G"); //Variable para extender la memoria del cache
		ini_set('max_execution_time', '0'); //Variable para quitar limite de timpo de ejecucion

        $archivo = storage_path('files/')."cinco.csv"; //Nombre y ruta del archivo a sincronizar


        /**
         * Se ejecuta la clase Excel para leer el archivo  y registrar los datos en la BD
         */
        Excel::load($archivo, function($reader) {

    		$results = $reader->get(); 
    		//$i=0;
    		echo "<h2>Por favor espere se estan cargando los datos...</h2>";
    		foreach ($results as $value) {

    			Beneficiario::create([
		            'nombre_beneficiario'        => $value->nombre,
		            'primer_apellido_beneficiario'     => $value->paterno,
		            'segundo_apellido_beneficiario'      => $value->materno,
		            'edad' => $value->edad,
		            'ocupacion' => $value->ocupacion,
		            'clave_electoral' => $value->clave_ele,
		            'secc_electoral'  => $value->seccion,
		            'num_int' => $value->num_int,
		            'num_ext' => $value->num,
		            'colonia' => $value->colonia,
		            'calle' => $value->calle,
		            'cp' => $value->cp,
		            'tel_casa' => null,
		            'tel_cel' => null,
		            'email' => null,
		            'comentario' => null,
	            ]);

    			//echo $i++."<br>";

    		}

    			//echo "<h2>Done...</h2>";

		})->get();

		return Redirect::back()
            	->with('message_success', 'Datos cargados correctamente');

    }

}
