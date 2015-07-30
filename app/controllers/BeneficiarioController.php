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
        
    	$persona = Beneficiario::where('clave_electoral', $clave_elector)->get()->first();
        $apoyos = $persona->apoyos()->get();

        if (is_null($persona)) {
            return Redirect::back()->with('message_warning', 'No se encontro la persona buscada');;
        }
    	
    	return View::make('apoyos/beneficiario1')
    			->with('persona', $persona)
                ->with('apoyos', $apoyos);
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

    public function asignarApoyo()
    {
        return Dependencia::find(1)->programas()->get();
    }
}
