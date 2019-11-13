<?php

use Illuminate\Database\Seeder;

class Niveles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Nivel')->insert([
            'id' => 1,
            'NIVEL' => 'Principiante',
            'PUNTAJE_MINIMO'=>'1',
            'BAGDE'=>'NO_IMAGE',
            'BACKGROUND'=>'NO_IMAGE',
        ]);
        DB::table('Nivel')->insert([
            'id' => 2,
            'NIVEL' => 'Soldado',
            'PUNTAJE_MINIMO'=>'10',
            'BAGDE'=>'NO_IMAGE',
            'BACKGROUND'=>'NO_IMAGE',
        ]);
        DB::table('Nivel')->insert([
            'id' => 3,
            'NIVEL' => 'Avanzado',
            'PUNTAJE_MINIMO'=>'20',
            'BAGDE'=>'NO_IMAGE',
            'BACKGROUND'=>'NO_IMAGE',
        ]);
        DB::table('Nivel')->insert([
            'id' => 4,
            'NIVEL' => 'Rey',
            'PUNTAJE_MINIMO'=>'30',
            'BAGDE'=>'NO_IMAGE',
            'BACKGROUND'=>'NO_IMAGE',
        ]);

    }
}
