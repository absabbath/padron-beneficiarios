<?php

class AdminController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));
        if (! Auth::user()->hasRole('Administrador') && ! Auth::user()->hasRole('root')) {

            Auth::logout();

            return Redirect::action('LoginController@anyLogout')
              ->with('message_danger', 'No tienes permiso de entrar a esa seccion');
        }

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
     * export Exporta la consulta en la que se este a documento de 
     *         hoja de calculo
     * @return Response Descarga el documento resultante
     */
    public function export()
    {
        
        $name = Session::get('name');
        
        Excel::create($name, function($excel) {
            
        $excel->sheet('Padron_Beneficiarios', function($sheet) {
            $data = Session::get('export');
            $headers = ['Clave elector', 'Nombre beneficiario', 'Primer apellido', 'Segundo apellido', 
                    'Edad', 'Sexo', 'Ocupación', 'Seccion electoral', 'Calle', 'Colonia',
                    'Número', 'Dependencia', 'Fecha', 'Tipo apoyo', 'Descripción apoyo', 'Monto'];
            $todo =[$headers];

            foreach ($data as $apoyo) {

                $row = [
                    $apoyo->beneficiario()->first()->clave_electoral,
                    $apoyo->beneficiario()->first()->nombre_beneficiario,
                    $apoyo->beneficiario()->first()->primer_apellido_beneficiario,
                    $apoyo->beneficiario()->first()->segundo_apellido_beneficiario,
                    $apoyo->beneficiario()->first()->edad,
                    $apoyo->beneficiario()->first()->sexo,
                    $apoyo->beneficiario()->first()->ocupacion,
                    $apoyo->beneficiario()->first()->secc_electoral,
                    $apoyo->beneficiario()->first()->calle,
                    $apoyo->beneficiario()->first()->colonia,
                    $apoyo->beneficiario()->first()->num_ext,
                    $apoyo->getDependencia($apoyo->id_subprogramas),
                    $apoyo->fecha,
                    $apoyo->buscarTipo($apoyo->id_tipo_apoyos),
                    $apoyo->concepto,
                    $apoyo->monto
                    ];
                $todo []=$row;
            }

            $sheet->freezeFirstRow();

            $sheet->fromArray($todo, null, 'A1', false, false);
            
         });

      })->export('xlsx');


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
                    'sexo'                           => $value->sexo,
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


    /**
     * busquedaAdmin  Lleva a la vista para realizar busquedas
     * @return View Plantilla de busquedas
     */
    public function busquedaAdmin()
    {
        $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');

        return View::make('admin/reportes/filtros')
                ->with('combo', $dependencias);
    }

    /**
     * reporte Realiza la busqueda de acuerdo al valor retornado
     * @param  string $tipo Tipo de busqueda
     * @return View       Vista de resultados
     */
    public function reporte($tipo)
    {   
        $aux = null;
        $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');
        $consulta = "";
        $sesion =[];
        $contador = 0;

        switch ($tipo) {

            case 'seccion':

                $seccion = Input::get('seccion');
                $personas = Beneficiario::where('secc_electoral', $seccion)->lists('id');
                $consulta = "seccion electoral: ".$seccion;
                $apoyos = Apoyo::whereIn('id_beneficiarios', $personas)->paginate();
                $sesion= Apoyo::whereIn('id_beneficiarios', $personas)->get();
                $query = array_except( Input::query(), Paginator::getPageName() );
                $aux = $apoyos;
                $aux->appends($query);
                
                break;


            case 'dependencia':

                $id_dependencia = Input::get('dependencia');
                $dependencia = Dependencia::find($id_dependencia);
                $consulta = "dependencia: ".$dependencia->nombre_dependencia;
                $subprogramas = $this->showSubprogramas($dependencia);
           
                $apoyos = Apoyo::whereIn('id_subprogramas', $subprogramas)->paginate();
                $contador = Apoyo::whereIn('id_subprogramas', $subprogramas)->count();
                $sesion= Apoyo::whereIn('id_subprogramas', $subprogramas)->get();
                $query = array_except( Input::query(), Paginator::getPageName() );
                $aux = $apoyos;
                $aux->appends($query);

                break;


            case 'fecha':

                $inicio = Input::get('inicio');
                $fin = Input::get('fin');
                $consulta = "fecha: De ".$inicio." a ".$fin;
                $apoyos = Apoyo::where('fecha','>=',$inicio )->where('fecha', '<=', $fin)->paginate();
                $sesion= Apoyo::where('fecha','>=',$inicio )->where('fecha', '<=', $fin)->get();
                $query = array_except( Input::query(), Paginator::getPageName() );
                $aux = $apoyos;
                $aux->appends($query);

                break;

            case 'todos':

                $apoyos = Apoyo::paginate();
                $sesion = Apoyo::all();
                $consulta = "todos";
                $query = array_except( Input::query(), Paginator::getPageName() );
                $aux = $apoyos;
                $aux->appends($query);

                break;
            
            default:
                return "No existe esa busqueda";
                break;
        }
        
        Session::put('export',$sesion);
        Session::put('name', $consulta);

        return View::make('admin/reportes/resultados')
                    ->with('apoyos',$aux)
                    ->with('contador',$contador)
                    ->with('combo', $dependencias)
                    ->with('msj', 'Consulta por '.$consulta);
        
    }

    public function showSubprogramas($dependencia)
    {
        
        $programas = $dependencia->programas()->get();

        $subprogramas = [];
        foreach ($programas as $programa) {
            $sub_aux = $programa->subprogramas()->get();
            foreach ($sub_aux as  $sub) {
                $subprogramas []= $sub->id;
            }
        }

        return $subprogramas;
    }

    public function showAvance()
    {
        $dependencias = Dependencia::all();
        $reporte = [];
        foreach ($dependencias as $dependencia) {

            $subprogramas = $this->showSubprogramas($dependencia);
            $contador = Apoyo::whereIn('id_subprogramas', $subprogramas)->count();
            $reporte[]=['Contador' => $contador, 'Dependencia'  => $dependencia->nombre_dependencia];
        }       

        return View::make('admin/reportes/reporte')->with('reporte', $reporte);
    
    }

}
