<?php

use Illuminate\Database\Seeder;

class EstadoEjemplarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estadoEjemplar')->insert([
            'ID_ESTADO_EJEMPLAR' => 1,
            'NOMBRE' => 'BUENO'
        ]);
        DB::table('estadoEjemplar')->insert([
            'ID_ESTADO_EJEMPLAR' => 2,
            'NOMBRE' => 'MALO'
        ]);
        DB::table('estadoEjemplar')->insert([
            'ID_ESTADO_EJEMPLAR' => 3,
            'NOMBRE' => 'REGULAR'
        ]);
    }
}
