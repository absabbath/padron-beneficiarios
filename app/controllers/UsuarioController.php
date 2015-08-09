<?php

class UsuarioController extends BaseController {

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
        $users = User::all();
        return View::make('admin/usuario/index')->with('users',$users);
    }

    public function create()
    {
         $roles = Rol::where('id','>', 1)->lists('name', 'id');
         $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');

         return View::make('admin/usuario/create')
                    ->with('roles', $roles)
                    ->with('dependencias', $dependencias); 

    }

    public function store()
    {
        $usuario = new User;
        $data = Input::all();
      //Si error regresa a la acción create con los datos y errores encontrados
        if (!$usuario->isValid($data)) {
            return Redirect::route('admin.usuario.create')
            ->withInput()
            ->withErrors($usuario->errors);
        }
     //Si la data es valida se la asignamos al usuarios
        $usuario = new User(array(
        'login' => Input::get('login'),
        'email' => Input::get('email'),
        'nombre' => Input::get('nombre'),
        'primer_apellido' => Input::get('primer_apellido'),
        'segundo_apellido' => Input::get('segundo_apellido'),
        'id_rol' => Input::get('id_rol'),
        'id_dependencia' => Input::get('id_dependencia'),
        'estatus' => 1,
        ));

        $usuario->save();
        return Redirect::route('admin.usuario.index');
    }

    public function show($id)
    {
        return "show".$id;
    }

    public function edit($id)
    {
         $roles = Rol::where('id','>', 1)->lists('name', 'id');
         $dependencias = Dependencia::all()->lists('nombre_dependencia', 'id');

         $usuario = User::find($id);

         return View::make('admin/usuario/edit')
                    ->with('usuario', $usuario)
                    ->with('roles', $roles)
                    ->with('dependencias', $dependencias); 
    }

    public function update($id)
    {
        $user = User::find($id);

        if (is_null ($user)) App::abort(404);

        $data = Input::all();

        if (!$user->validAndSave($data)) {
            return Redirect::route('admin.usuario.edit', $user->id)
                ->withInput()
                ->withErrors($user->errors);
        }

        return Redirect::route('admin.usuario.index');
        
    }

    public function destroy($id)
    {
        
    }



}
