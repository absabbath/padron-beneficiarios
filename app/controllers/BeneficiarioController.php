<?php

class BeneficiarioController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

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
        $apoyo = new Apoyo(array(
        'monto' => Input::get('monto'),
        'fecha' => Input::get('inicio'),
        'concepto' => Input::get('concepto'),
        'periodicidad' => Input::get('periodicidad'),
        'id_tipo_apoyos' => Input::get('tipo'),
        'id_beneficiarios' => Input::get('id_beneficiario'),
        'id_subprogramas' => Input::get('subprogramas'),
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

    public function getBeneficiarios()
    {
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
    }

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
