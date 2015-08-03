<?php

class AdminController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    /**
     * inicio redirecciona a  vista principal de administrador
     * con las lista de archivos disponibles a sincronizar
     * @return [type] [description]
     */
    public function inicio()
    {
    	$lista = $this->getFiles(storage_path('files/'));
    	return View::make('admin/index')->with('lista', $lista);
    }


    /**
     * upload en esta funcion se sube el archivo al servidor
     * @return [type] [description]
     */
    public function upload()
    {
    	$nombre = "";
    	if(Input::hasFile('archivo')) {
    		$ruta = storage_path('files/');
    		$nombre = Input::file('archivo')->getClientOriginalName(); ;
          	Input::file('archivo')->move($ruta,$nombre);
     	}



     	return Redirect::back();

    }


    /**
     * getFiles Obtiene los nombre de archivos en el servidor
     * @param  string $path Ruta a buscar
     * @return [type]       [description]
     */
    public function getFiles($path)		
    {
    	$lista = "";
    	
	    if(is_dir($path)) {
	        if($dir = opendir($path)){
	            while(($archivo = readdir($dir)) !== false){
	                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
	                    //$lista .= '<li><a target="_blank" href="'.$path.'/'.$archivo.'">'.$archivo.'</a></li>';
	                	$lista[$archivo.''] = $archivo;
	                }
	            }
	            closedir($dir);
	        }
	    }

	    return $lista;

    }

   
    /**
     * sincroniza Funcion para sincronizar datos del archivo excel a la BD
     * @return Redirect Redirecciona a la vista anterior con el mensaje de 
     *                               confirmacion de sincroniacion
     */
    
    public function sincroniza()
    {

		ini_set("memory_limit","2G"); //Variable para extender la memoria del cache
		ini_set('max_execution_time', '0'); //Variable para quitar limite de timpo de ejecucion

        $archivo = storage_path('files/').Input::get('subir'); //Nombre y ruta del archivo a sincronizar


        /**
         * Se ejecuta la clase Excel para leer el archivo  y registrar los datos en la BD
         */
        Excel::load($archivo, function($reader) {

    		$results = $reader->get(); 
    		//$i=0;
    		echo "<h2>Por favor espere se estan cargando los datos...</h2>";
    		foreach ($results as $value) {

    			Beneficiario::create([
		            'nombre_beneficiario'            => $value->nombre,
		            'primer_apellido_beneficiario'   => $value->paterno,
		            'segundo_apellido_beneficiario'  => $value->materno,
		            'edad'                           => $value->edad,
		            'ocupacion'                      => $value->ocupacion,
		            'clave_electoral'                => $value->clave_ele,
		            'secc_electoral'                 => $value->seccion,
		            'num_int'                        => $value->num_int,
		            'num_ext'                        => $value->num,
		            'colonia'                        => $value->colonia,
		            'calle'                          => $value->calle,
		            'cp'                             => $value->cp,
		            'tel_casa'                       => null,
		            'tel_cel'                        => null,
		            'email'                          => null,
		            'comentario'                     => null,
	            ]);

    			//echo $i++."<br>";

    		}

    			//echo "<h2>Done...</h2>";

		})->get();

		return Redirect::action('AdminController@inicio')
            	->with('message_success', 'Datos cargados correctamente');

    }


    public function busquedaAdmin()
    {
        $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');

        return View::make('admin/reportes/filtros')
                ->with('combo', $dependencias);
    }

    public function reporte($tipo)
    {   
        $aux = null;
        $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');

        switch ($tipo) {

            case 'seccion':
                $seccion = Input::get('seccion');
                $apoyos = Beneficiario::where('secc_electoral', $seccion)->get();
                
                break;


            case 'dependencia':
                # code...
                break;


            case 'fecha':
                $inicio = Input::get('inicio');
                $fin = Input::get('fin');
                $apoyos = Apoyo::where('fecha','>=',$inicio )->where('fecha', '<=', $fin)->get();
                $aux = $apoyos;
                break;
            
            default:
                # code...
                break;
        }

        //return $aux;

        return View::make('admin/reportes/resultados')
                    ->with('apoyos',$aux)
                    ->with('combo', $dependencias);
        
    }

}
