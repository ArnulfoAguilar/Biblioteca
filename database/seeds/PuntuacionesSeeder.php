<?php

use Illuminate\Database\Seeder;

class PuntuacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Puntuacion')->insert([
            'id' => 1,
            'PUNTUACION' => 'VER APORTE',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 2,
            'PUNTUACION' => 'COMENTAR APORTE',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 3,
            'PUNTUACION' => 'REALIZAR APORTE ESCRITO',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 4,
            'PUNTUACION' => 'REALIZAR APORTE VIDEO',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 5,
            'PUNTUACION' => 'REALIZAR APORTE PINTURA',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 6,
            'PUNTUACION' => 'REALIZAR APORTE MUSICA',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 7,
            'PUNTUACION' => 'PRESTAR LIBRO',
            'VALOR'=>1
        ]);
        DB::table('Puntuacion')->insert([
            'id' => 8,
            'PUNTUACION' => 'APORTE HABILITADO',
            'VALOR'=>1
        ]);
    }
}
