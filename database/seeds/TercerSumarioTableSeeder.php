<?php

use Illuminate\Database\Seeder;

class TercerSumarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tercerSumario')->insert([
            'id' => 1,
            'DESCRIPCION' => '221 - Antiguo Testamento',
            'ID_SEGUNDO_SUMARIO' => 4
        ]);
        DB::table('tercerSumario')->insert([
            'id' => 2,
            'DESCRIPCION' => '222 - Libros Históricos del Antiguo Testamento',
            'ID_SEGUNDO_SUMARIO' => 4
        ]);
        DB::table('tercerSumario')->insert([
            'id' => 3,
            'DESCRIPCION' => '152 - Persepción, Movimiento, Emociones, Impulsos',
            'ID_SEGUNDO_SUMARIO' => 3
        ]);
        DB::table('tercerSumario')->insert([
            'id' => 4,
            'DESCRIPCION' => '154 - Subconsiente & Estados alterados ',
            'ID_SEGUNDO_SUMARIO' => 3
        ]);
        DB::table('tercerSumario')->insert([
            'id' => 5,
            'DESCRIPCION' => '121 - Epistemología, Teoría del Conocimiento ',
            'ID_SEGUNDO_SUMARIO' => 2
        ]);
    }
}
