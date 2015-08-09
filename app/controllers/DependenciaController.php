<?php

class DependenciaController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));
        if (! Auth::user()->hasRole('Administrador') && ! Auth::user()->hasRole('root')) {

            Auth::logout();

            return Redirect::action('LoginController@anyLogout')
              ->with('message_danger', 'No tienes permiso de entrar a esa seccion');
        }

    }

    public function index()
    {
        $dependencias = Dependencia::all();
        return View::make('admin/dependencia/index')->with('dependencias',$dependencias);
    }

    public function create()
    {
        return View::make('admin/dependencia/create');
    }

    public function store()
    {
        $dependencia = new Dependencia;
        $data = Input::all();
      //Si error regresa a la acción create con los datos y errores encontrados
        if (!$dependencia->isValid($data)) {
            return Redirect::route('admin.dependencia.create')
            ->withInput()
            ->withErrors($dependencia->errors);
        }
     //Si la data es valida se la asignamos al usuarios
        $dependencia = new Dependencia(array(
        'nombre_dependencia' => Input::get('nombre_dependencia'),
        'nombre_director' => Input::get('nombre_director'),
        'primer_apellido' => Input::get('primer_apellido'),
        'segundo_apellido' => Input::get('segundo_apellido'),
        ));
        $dependencia->save();
        return Redirect::route('admin.dependencia.index');
    }

    public function show($id)
    {
        return "show".$id;
    }

    public function edit($id)
    {
        $dependencia = Dependencia::find($id);
        if (is_null($dependencia)) App::abort(404);
        return View::make('admin/dependencia/edit', array('dependencia' => $dependencia));
    }

    public function update($id)
    {
        $dependencia = Dependencia::find($id);
        if (is_null($dependencia)) App::abort(404);
        $data = Input::all();
        if (!$dependencia->validAndSave($data)) {
            return Redirect::route('admin.dependencia.edit', $dependencia->id)
            ->withInput()
            ->withErrors($dependencia->errors);
        }
        return Redirect::route('admin.dependencia.index');
    }

    public function destroy($id)
    {
        
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

}
