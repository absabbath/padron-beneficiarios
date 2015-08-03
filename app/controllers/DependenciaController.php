<?php

class DependenciaController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

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

}
