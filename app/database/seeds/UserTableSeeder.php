<?php

class UserTableSeeder extends Seeder {

    public function run()
    {

        DB::table('users')->delete();
        $usuario = new User;

        $usuario->login = 'admin';
        $usuario->email = 'angelmartin.isc@gmail.com';
        $usuario->password = Hash::make('admin');

        $usuario->nombre = 'Super usuario';
        $usuario->primer_apellido = 'root';
        $usuario->segundo_apellido = 'root';

        $usuario->id_rol = 1; //1 siempre es administrador
        $usuario->estatus = 1; //1 siempre es activo

        $usuario->save();

    }

}
