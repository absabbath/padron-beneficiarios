<?php

/**
 * Este seeder puede ser utilizado para poblar la BD y hacer diferentes pruebas
 */
class LlenarSeeder extends Seeder {

    public function run()
    {

     
        $faker = Faker\Factory::create('es_ES');
        foreach(range(1, 9) as $index)
        {
            User::create([
                'nombre'        => $faker->word,
                'email' => $faker->word,
                'login'   => $faker->word ,
                'password'         => Hash::make($faker->word),
                'primer_apellido'     => $faker->word,
                'segundo_apellido'      => $faker->word,
                'id_rol' => 2,
                'estatus'  => 1,
            ]);
        }

        foreach(range(1, 9) as $index)
        {
            Dependencia::create([
                'nombre_dependencia'   => $faker->cityPrefix ,
                'nombre_director'      => $faker->name,
                'primer_apellido'      => $faker->lastName,
                'segundo_apellido'     => $faker->lastName,
            ]);
        }

    }

}
