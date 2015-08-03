<?php

class UsuarioController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function index()
    {
        $users = User::all();
        return View::make('admin/usuario/index')->with('users',$users);
    }

    public function create()
    {
         
         return View::make('admin/usuario/create'); 

    }

    public function store()
    {
        
    }

    public function show($id)
    {
        return "show".$id;
    }

    public function edit($id)
    {
         return View::make('admin/usuario/edit'); 
    }

    public function update($id)
    {
        
    }

    public function destroy($id)
    {
        
    }



}
