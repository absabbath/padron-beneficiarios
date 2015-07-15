<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {

        DB::table('roles')->delete();
        // $usuario = new User;

        // $usuario->login = 'admin';
        // $usuario->email = 'gilkudik@gmail.com';
        // $usuario->password = Hash::make('Ninguna123');

        // $usuario->nombre = '';
        // $usuario->primer_apellido = '';
        // $usuario->segundo_apellido = '';

        // $usuario->id_rol = 1; //1 siempre es administrador
        // $usuario->estatus = 1; //1 siempre es activo

        // $usuario->save();

        Rol::create(array(
            'name'            => 'Administrador',
            'description'       => 'Administrador del panel, Super usuario',
        ));

        Rol::create(array(
            'name'            => 'Usuario',
            'description'     => 'Rol con privilegios de lectura',
        ));

    }

}
