<?php

class LlenarSeeder extends Seeder {

    public function run()
    {

     
        $faker = Faker\Factory::create('es_ES');
        foreach(range(1, 50000) as $index)
        {
            User::create([
                'nombre'        => $faker->word,
                'email' => $faker->word,
                'login'   => $faker->word ,
                'password'         => Hash::make($faker->word),
                'primer_apellido'     => $faker->word,
                'segundo_apellido'      => $faker->word,
                'id_rol' => 1,
                'estatus'  => 1,
            ]);
        }

    }

}
