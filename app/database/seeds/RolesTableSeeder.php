<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {

        DB::table('roles')->delete();

        Rol::create(array(
            'name'            => 'root',
            'description'       => 'In root with trust',
        ));
        
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
