<?php

class UsuarioController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function ver()
    {
    	$usuarios=User::all();
    	//$usuarios="tepetongo";
        return View::make('usuarios/lista')
        	->with('usuarios',$usuarios);


    }

}
