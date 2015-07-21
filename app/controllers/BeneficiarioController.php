<?php

class BeneficiarioController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function buscarBeneficiario($clave_elector)
    {
        
    	$persona = Beneficiario::where('clave_electoral', $clave_elector)->get()->first();
    	
    	return View::make('apoyos/beneficiario1')
    			->with('persona', $persona);
    }

    public function update($id)
    {
        $persona = Beneficiario::find($id);
        $persona->tel_casa = Input::get('tel_casa');
        $persona->tel_cel = Input::get('tel_cel');
        $persona->email = Input::get('email');
        $persona->comentario = Input::get('comentario');
        $persona->save();
        return Redirect::back()->with('message_info', 'Datos actualizados correctamente');;
        

    }
}
