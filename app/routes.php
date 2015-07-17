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
