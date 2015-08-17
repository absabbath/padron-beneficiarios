<?php

class BeneficiarioController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function irNuevo()
    {
        $beneficiario = new Beneficiario;
        return View::make('apoyos/nuevo-beneficiario')->with('beneficiario', $beneficiario);
    }

    public function irEditar($id)
    {
        $beneficiario = Beneficiario::find($id);
        return View::make('apoyos/nuevo-beneficiario')->with('beneficiario', $beneficiario);
    }

    public function updateNuevo($id)
    {
        $beneficiario = Beneficiario::find($id);
        if (is_null($beneficiario)) App::abort(404);

        $data = Input::all();
        $data = array_map('strtoupper', $data);

        if (!$beneficiario->validAndSave($data)) {
            return Redirect::route('beneficiario.editar', $beneficiario->id)
            ->withInput()
            ->withErrors($beneficiario->errors);
        }
        return Redirect::route('buscar.beneficiario', [$beneficiario->clave_electoral]);
    }

    public function guardarNuevo()
    {
        $cv_aux = Input::get('clave_electoral');
        $edad_aux = Input::get('edad');
        $cp_aux = Input::get('cp');

        if (Input::get('edad') == "") {
            $edad_aux = 18;
        }

        if (Input::get('cp') == "") {
            $cp_aux = 0;
        }

        if (Input::get('clave_electoral') == "") {
            $cv_aux = Beneficiario::count()+1;
        }

        $ben = new Beneficiario;
        $data = Input::all();
      //Si error regresa a la acción create con los datos y errores encontrados
        if (!$ben->isValid($data)) {
            return Redirect::route('nuevo.beneficiario.create')
            ->withInput()
            ->withErrors($ben->errors);
        }

        $nuevo = new Beneficiario([
            'clave_electoral'               => strtoupper($cv_aux),
            'nombre_beneficiario'           => strtoupper(Input::get('nombre_beneficiario')),
            'primer_apellido_beneficiario'  => strtoupper(Input::get('primer_apellido_beneficiario')),
            'segundo_apellido_beneficiario' => strtoupper(Input::get('segundo_apellido_beneficiario')),
            'secc_electoral'                => strtoupper(Input::get('secc_electoral')),
            'sexo'                          => strtoupper(Input::get('sexo')),
            'edad'                          => $edad_aux,
            'ocupacion'                     => strtoupper(Input::get('ocupacion')),
            'calle'                         => strtoupper(Input::get('calle')),
            'num_ext'                       => strtoupper(Input::get('num_ext')),
            'num_int'                       => strtoupper(Input::get('num_int')),
            'colonia'                       => strtoupper(Input::get('colonia')),
            'cp'                            => $cp_aux,
            ]);

        $nuevo->save();
        return Redirect::route('buscar.beneficiario', [$nuevo->clave_electoral]);

    }

    /**
     * buscarBeneficiario Buscar por clave de elector
     * @param  string $clave_elector clave
     * @return View                Muestra la vista del beneficiario
     */
    public function buscarBeneficiario($clave_elector)
    {
        if ($clave_elector=='buscador') {
            $clave_elector = Input::get('q');
        }

        $clave_elector = strtoupper($clave_elector);

    	$persona = Beneficiario::where('clave_electoral', $clave_elector)->get()->first();
        if (is_null($persona)) {
            return Redirect::back()->with('message_warning','No se encontro la persona');
        }
        $apoyos = $persona->apoyos()->get();

        if (is_null($persona)) {
            return Redirect::back()->with('message_warning', 'No se encontro la persona buscada');;
        }
    	
    	return View::make('apoyos/beneficiario1')
    			->with('persona', $persona)
                ->with('apoyos', $apoyos);
    }

    public function buscaSimilares()
    {

        $nombre = strtoupper(Input::get('nombre'));
        $apellido = strtoupper(Input::get('primer_apellido'));
       

        $personas = Beneficiario::where('nombre_beneficiario',$nombre)
                        ->where('primer_apellido_beneficiario', $apellido)->get();

        if ($personas == "[]") {
            return Redirect::back()->with('message_warning', 'No se encontro la persona buscada');;
        }
        

        return View::make('apoyos/coincidencias')
                ->with('personas', $personas);

    }

    /**
     * buscador envia a la vista de del buscador
     * @return View Retorna a la vista correspondiente
     */
    public function buscador()
    {
        return View::make('apoyos/buscador');
    }

    /**
     * update actualiza los datos faltantes del beneficiario
     * @param  int $id id del beneficiario
     * @return Response    Mensaje de confirmacion 
     */
    public function update($id)
    {
        $persona = Beneficiario::find($id);
        $persona->tel_casa = Input::get('tel_casa');
        $persona->tel_cel = Input::get('tel_cel');
        $persona->email = Input::get('email');
        $persona->comentario = Input::get('comentario');
        $persona->save();
        return Redirect::back()->with('message_info', 'Datos actualizados correctamente');
        

    }

    /**
     * asignarApoyo Realiza el registro a la BD de cada apoyo
     * @return Response     Redirecciona atras con mensaje de confirmacion
     */
    public function asignarApoyo()
    {
        $apoyo = new Apoyo();
        $data = Input::all();

        if (!$apoyo->isValid($data)) {
            return Redirect::back()->withErrors($apoyo->errors);
        }
        $apoyo = new Apoyo(array(
        'monto' => Input::get('monto'),
        'fecha' => Input::get('fecha'),
        'concepto' => Input::get('concepto'),
        'periodicidad' => Input::get('periodicidad'),
        'id_tipo_apoyos' => Input::get('tipo'),
        'id_beneficiarios' => Input::get('id_beneficiario'),
        'id_subprogramas' => Input::get('id_subprogramas'),
        ));
        $apoyo->save();

        return Redirect::back()->with('message_success', 'Nuevo apoyo asignado');

    }

    /**
     * detalle Funcion que consulta el detalle de un apoyo, esta es realizada
     * desde jquery
     * @return array La informacion depurada de un apoyo
     */
    public function detalle()
    {

        $id_apoyo = Input::get('apoyo');
        $apoyo = Apoyo::find($id_apoyo);
        $obj = new Apoyo();

        $programa = SubPrograma::find($apoyo->id_subprogramas)->programa()->get()->first();
        $dependencia = Dependencia::find($programa->id_dependencia);

        $usuario =  $dependencia->usuarios()->first()->nombre." ".
                    $dependencia->usuarios()->first()->primer_apellido." ".
                    $dependencia->usuarios()->first()->segundo_apellido;

        $todo = [
        'Tipo de apoyo' => $obj->buscarTipo($apoyo->id_tipo_apoyos),
        'Concepto' => $apoyo->concepto,
        'Monto $' => $apoyo->monto,
        'Fecha otorgado' => $apoyo->fecha,
        'Periodicidad' => $apoyo->periodicidad,
        'Otorgado por(Dependencia)' => $obj->getDependencia($apoyo->id_subprogramas),
        'Funcionario que otorgó' => $usuario];

        return $todo;
    }

    /**
     * getBeneficiarios Encuentra los apoyos otorgados por el usuario actual
     * @return View Retorna los datos a la vista correspondientes
     */
    public function getBeneficiarios()
    {
        if (! Auth::user()->hasRole('Administrador') && ! Auth::user()->hasRole('root')) {
            
            $id_dependencia = Auth::user()->dependencia()->get()->first()->id;
            $dependencia = Dependencia::find($id_dependencia);
            $programas = $dependencia->programas()->get();

            $subprogramas = [];
            foreach ($programas as $programa) {
                $sub_aux = $programa->subprogramas()->get();
                foreach ($sub_aux as  $sub) {
                    $subprogramas []= $sub->id;
                }
            }
               
            $apoyos = Apoyo::whereIn('id_subprogramas', $subprogramas)->paginate();
            $sesion= Apoyo::whereIn('id_subprogramas', $subprogramas)->get();
            Session::put('exportar', $sesion);

            return View::make('apoyos/consulta')->with('apoyos', $apoyos);
        } else {
            $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');

            return View::make('admin/reportes/filtros')
                    ->with('combo', $dependencias);
        }
    }

    /**
     * exportaMisBeneficiarios Funcion para exportar a hoja de calculo
     * @return Reponse Descarga los datos en formato de hoja de calculo
     */
    public function exportaMisBeneficiarios()
    {
        
        Excel::create('Mis_Beneficiarios', function($excel) {
            
        $excel->sheet('Padron_Beneficiarios', function($sheet) {
            $data = Session::get('exportar');
            $headers = ['Clave elector', 'Nombre beneficiario', 'Primer apellido', 'Segundo apellido', 
                    'Edad', 'Calle', 'Colonia',
                    'Número', 'Fecha', 'Tipo apoyo', 'Descripción apoyo', 'Monto'];
            $todo =[$headers];

            foreach ($data as $apoyo) { 

                $row = [
                    $apoyo->beneficiario()->first()->clave_electoral,
                    $apoyo->beneficiario()->first()->nombre_beneficiario,
                    $apoyo->beneficiario()->first()->primer_apellido_beneficiario,
                    $apoyo->beneficiario()->first()->segundo_apellido_beneficiario,
                    $apoyo->beneficiario()->first()->edad,
                    $apoyo->beneficiario()->first()->calle,
                    $apoyo->beneficiario()->first()->colonia,
                    $apoyo->beneficiario()->first()->num_ext,
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
     * getSubPrograma obtiene los subprogramas de acuerdo al programa seleccionado
     *                 envia por medio de JQuery
     * @return array Respuesta jquery
     */
    public function getSubPrograma()
    {
        $id = Input::get('programa');

        if($id == 0){
            $combo [0] = "Primero elije un programa";
            return  $combo;
        }
        
        $subprograma = Programa::find($id)->subprogramas;
        return $subprograma->lists('nombre_subprograma', 'id');
    }


}
