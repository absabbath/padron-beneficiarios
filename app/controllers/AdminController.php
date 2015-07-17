<?php

class AdminController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function panelAdmin()
    {


        return View::make('admin/index');

    	
    	/**Esta es una prueba, para comprobar el funcionamiento de las operaciones
    	***para con las hojas de calculo
    	$calculo = Excel::create('prueba', function($excel) {
	   	$excel->setTitle('Our new awesome title');
	    $excel->setCreator('Maatwebsite')
	          ->setCompany('Maatwebsite');
	    $excel->setDescription('A demonstration to change the file properties');
		});

		return $calculo->download('xls');
		**/
    }

}
