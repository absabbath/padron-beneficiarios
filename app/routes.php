<?php

/**
 * Rutas de login
 */
Route::get  ('login',  'LoginController@getLogin'   );
Route::post ('login',  'LoginController@postLogin'   );
Route::any  ('logout', 'LoginController@anyLogout'   );

Route::get  ('password/remind', 'RemindersController@getRemind' );
Route::post ('password/remind', 'RemindersController@postRemind' );
Route::get  ('password/reset/{token}',  'RemindersController@getReset' );
Route::post ('password/reset',  'RemindersController@postReset' );


/**
 * Rutas de la app
 */
Route::any  ('/',  'HomeController@showWelcome'   );
Route::get('admin', 'AdminController@panelAdmin');
Route::resource('admin/usuario','UsuarioController');
Route::resource('admin/dependencia','DependenciaController');

/**
 * Rutas de testeo
 */
Route::controller('testing', 'TestingController' );

/**
 * Ruta por default para contenidos no encontrados
 */
App::missing(function($exception)
{
    return Redirect::action('HomeController@showWelcome');
    // return Response::view('errors/404', array(), 404);
});




/**
 * Todo lo comentado es para hacer una pruebas con tareas en segundo plano
 */

/*Route::get('redis', function(){

   Queue::push('Importar', array('titulo'=>'Importar datos', 'contenido'=>'Se importa el contenido'));

});*/

/*
class Importar {

    public function fire($tarea, $datos){

    	//ini_set("memory_limit","7G");
    	//ini_set('max_execution_time', '0');
    	ini_set('max_execution_time', '0');
		set_time_limit(0);
		ini_set('max_input_time', '0');
		ignore_user_abort(true);
		ini_set("memory_limit","7G");

    	echo "Preparandose para leer diez mil registros...";

    	$archivo = storage_path('files/')."diez.xlsx";

        Excel::load($archivo, function($reader) {
        	echo "Leyendo...<br>";
    			$results = $reader->get(); 

    			foreach ($results as $value) {
    			    echo $value->nombre."<br>";
    			}

		})->get();

		echo "Done!";
        
       
        $tarea->delete();        
    }

}*/
